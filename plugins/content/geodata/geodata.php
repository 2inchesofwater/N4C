<?php 
/**
* @version		1.0.0
* @package		Geodata
* @subpackage	Geodata
* @copyright	2013 2 Inches of Water, www.2inchesofwater.com
* @license		GNU GPL
*/

//No Permision
defined( '_JEXEC' ) or die( 'Restricted access' );

//jimport('joomla.html.parameter');

class plgContentGeodata extends JPlugin {
     
	 
public function __construct(& $subject, $config)
   {
      parent::__construct($subject, $config);
      $this->loadLanguage();
   }
   
public function onContentPrepareForm($form, $data)
   {
      if (!($form instanceof JForm))
      {
         $this->_subject->setError('JERROR_NOT_A_FORM');
         return false;
      }
 
      // Add the extra fields to the form.
      JForm::addFormPath(dirname(__FILE__). '/geodata');
      $form->loadFile('geodata', false);
      return true;
   }
   
public function onContentPrepareData($context, $data)
   {
      if (is_object($data))
      {
         $articleId = isset($data->id) ? $data->id : 0;
         if ($articleId > 0)
         {
            // Load the data from the database.
            $db = JFactory::getDbo();
            $query = $db->getQuery(true);
            $query->select('profile_key, profile_value');
            $query->from('#__user_profiles');
            $query->where('user_id = ' . $db->Quote($articleId));
            $query->where('profile_key LIKE ' . $db->Quote('geodata.%'));
            $query->order('ordering');
            $db->setQuery($query);
            $results = $db->loadRowList();
 
            // Check for a database error.
            if ($db->getErrorNum())
            {
               $this->_subject->setError($db->getErrorMsg());
               return false;
            }
 
            // Merge the data.
            $data->geodata = array();
 
            foreach ($geodata as $v)
            {
               $k = str_replace('geodata.', '', $v[0]);
               $data->geodata[$k] = json_decode($v[1], true);
               if ($data->geodata[$k] === null)
               {
                  $data->geodata[$k] = $v[1];
               }
            }
         } else {
            // load the form
            JForm::addFormPath(dirname(__FILE__) . '/geodata');
            $form = new JForm('com_content.article');
            $form->loadFile('geodata', false);
 
            // Merge the default values
            $data->geodata = array();
            foreach ($form->getFieldset('geodata') as $field) {
               $data->geodata[] = array($field->fieldname, $field->value);
            }
         }
      }
 
      return true;
   }
   
public function onContentAfterSave($context, &$article, $isNew)
   {
      $articleId = $article->id;
      if ($articleId && isset($article->geodata) && (count($article->geodata)))
      {
         try
         {
            $db = JFactory::getDbo();
 
            $query = $db->getQuery(true);
            $query->delete('#__user_profiles');
            $query->where('user_id = ' . $db->Quote($articleId));
            $query->where('profile_key LIKE ' . $db->Quote('geodata.%'));
            $db->setQuery($query);
            if (!$db->query()) {
               throw new Exception($db->getErrorMsg());
            }
 
            $query->clear();
            $query->insert('#__user_profiles');
            $order = 1;
            foreach ($article->geodata as $k => $v)
            {
               $query->values($articleId.', '.$db->quote('geodata.'.$k).', '.$db->quote(json_encode($v)).', '.$order++);
            }
            $db->setQuery($query);
 
            if (!$db->query()) {
               throw new Exception($db->getErrorMsg());
            }
         }
         catch (JException $e)
         {
            $this->_subject->setError($e->getMessage());
            return false;
         }
      }
 
      return true;
   }
   
public function onContentAfterDelete($context, $article)
   {
      $articleId = $article->id;
      if ($articleId)
      {
         try
         {
            $db = JFactory::getDbo();
 
            $query = $db->getQuery(true);
            $query->delete();
            $query->from('#__user_profiles');
            $query->where('user_id = ' . $db->Quote($articleId));
            $query->where('profile_key LIKE ' . $db->Quote('geodata.%'));
            $db->setQuery($query);
 
            if (!$db->query())
            {
               throw new Exception($db->getErrorMsg());
            }
         }
         catch (JException $e)
         {
            $this->_subject->setError($e->getMessage());
            return false;
         }
      }
 
      return true;
   }
   
public function onContentPrepare($context, &$article, &$params, $page = 0)
   {
      if (!isset($article->geodata) || !count($article->geodata))
         return;
 
      // add extra css for table
      $doc = JFactory::getDocument();
      $doc->addStyleSheet(JURI::base(true).'/plugins/content/geodata/geodata/geodata.css');
 
      // construct a result table on the fly   
      jimport('joomla.html.grid');
      $table = new JGrid();
 
      // Create columns
      $table->addColumn('attr')
         ->addColumn('value');   
 
      // populate
      $rownr = 0;
      foreach ($article->rating as $attr => $value) {
         $table->addRow(array('class' => 'row'.($rownr % 2)));
         $table->setRowCell('attr', $attr);
         $table->setRowCell('value', $value);
         $rownr++;
      }
 
      // wrap table in a classed <div>
      $suffix = $this->params->get('geodata_sfx', 'geodata');
      $html = '<div class="'.$suffix.'">'.(string)$table.'</div>';
 
      $article->text = $html.$article->text;
   }
   
}
?>

