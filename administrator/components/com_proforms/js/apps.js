// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// @license: Mad4Media Javascipt License - copyright Mad4Media - Fahrettin Kutyol - All rights reserved    ++
// (re-) publishing or forking for any purpose of commercial or non-commercial use is not allowed.		   ++
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


var multiIndexOf = function(arr,obj){
	if(!dojo.isIE) return arr.indexOf(obj);
	for(var i=0; i<arr.length; i++){
		if(arr[i]==obj){
			return i;
		}
	}
	return -1;
}


var FieldBalloon = {
		node: null,
		contentNode: null,
		target: null,
		multiple: 0,
		heap: null,
		name: null,
		namespace: null,
		decreasing: [],
		addCallBack: null,
		removeCallBack: null,
		isAlias: 0,
		switchAliasNode: null,
		allowed: null,
		showsCurrent: null,
		parseMode: 0,
		show: function(name,namespace,isMultiple,allowed){
			if(this.showsCurrent == name) this.hide();
			
	
			this.target = dojo.byId("sel_"+name);
			this.name = name;
			this.namespace = namespace;
			if(allowed !== undefined && allowed != null ){
				var split = allowed.split(",");
				for(t in split){
					split[t] = parseInt(split[t]);
				}
				this.allowed = split;
			}else{
				this.allowed = null;	
			}
			var ps = (namespace !== undefined && ProformsSelectors[namespace] !== undefined ) ? ProformsSelectors[namespace] : null;

			this.heap = ps ? ps.heap : "static";
			this.multiple = isMultiple;
			
			if(this.heap == "decreasing"){
				if(this.decreasing[namespace] === undefined){
					this.decreasing[namespace] = dojo.clone(eids);
				}				
			}
			
			if(!this.parseMode){
				this.create();
				var bounds = _ViewportOffset(dojo.byId("selector_"+name),true); 
				var docScroll = _docScroll(dojo.byId("selector_"+name));
				bounds.t += docScroll.top -222;
				bounds.l += docScroll.left;
				dojo.style(this.node, {opacity:0, left: bounds.l+"px", top: bounds.t+"px"});
				dojo.fadeIn({
					node: this.node
				}).play();
			}
		},
		hide: function(){
			dojo.fadeOut({
				node: this.node,
				onEnd: function(){
					dojo.style(FieldBalloon.node, {left: "-9999em"});
				}
			}).play();
		},
		create: function(){
			var isDecreasing = ( this.decreasing[this.namespace] !== undefined);
			var content = "";
			var elements = isDecreasing ? this.decreasing[this.namespace] : eids;
			
			var l = elements.length;
			var fe = formElements;
			for(var t=0; t<l ; t++){
				var key = "_"+elements[t];
				var isAllowed = 1;
				if(this.allowed){
					var form = fe[key].form;
					isAllowed = ( multiIndexOf( this.allowed, form ) != -1  );
				}
				if(isAllowed){
					var title = "";
					if(this.isAlias){
						title = fe[key].alias ? "{" + fe[key].alias + "}" : fe[key].question;
					}else{
						title = fe[key].question ? fe[key].question : "{" + fe[key].alias + "}";
					}
					if(title.length > 70){
						title = title.slice(0,67) + "...";
					}
					content += '<a onclick="javascript: FieldBalloon.add('+elements[t]+'); return false; ">' + title +'</a>';
				}//EOF is allowed
			}
			this.contentNode.innerHTML = content;
		},
		add: function(element){
			var selWrap = dojo.byId("selwrap_"+this.name);
			var spanWidth = selWrap.getAttribute("spanwidth");
			var SPAN = document.createElement("SPAN");
			dojo.style(SPAN,{width : spanWidth});
			SPAN.id = "span_" + this.name;
			SPAN.className = "selectedElements";
			var IMG = document.createElement("IMG");
			IMG.src= M4J_IMAGES + "remove.png";
			IMG.className = "add";
			IMG.id = "IMG_"+this.name;
			IMG.selWrap = selWrap;
			IMG.span = SPAN;
			IMG.target = this.target;
			IMG.removeCallBack = this.removeCallBack ? this.removeCallBack : null;
			IMG.decreasing = ( this.decreasing[this.namespace] !== undefined) ? this.decreasing[this.namespace] : null;
			IMG.elementID = element;
			dojo.connect(IMG,"onclick",function(el){
				var te = this.target.value.split(",");
				for( t in te){
					te[t] = parseInt(te[t]);
				}
				var idx = multiIndexOf( te, this.elementID );
				if(idx!=-1) te.splice(idx, 1); 
				this.target.value = te.join(",");
				
				if(this.decreasing){
					this.decreasing.push(parseInt(this.elementID));
				}
				
				if(this.removeCallBack) this.removeCallBack();
				this.selWrap.removeChild(this.span);
				this.selWrap.removeChild(this);
				FieldBalloon.create();
			});
			var key = "_"+element;
			var fe = formElements[key];
			SPAN.question =  fe.question;
			SPAN.alias =  fe.alias;
			if(this.isAlias){
				SPAN.innerHTML = fe.alias ? "{"+ fe.alias+"}" :  fe.question;
			}else{
				SPAN.innerHTML = fe.question ? fe.question : "{"+ fe.alias+"}";				
			}
			
			if(this.multiple){
			}else{
				selWrap.innerHTML = "";
			}

			selWrap.appendChild(SPAN);
			selWrap.appendChild(IMG);
			
			if ( this.decreasing[this.namespace] !== undefined){
				var idx = multiIndexOf( this.decreasing[this.namespace], element ); // Find the index
				if(idx!=-1) this.decreasing[this.namespace].splice(idx, 1); // Remove it if really found!
				
				if(!this.parseMode){
					if(!this.multiple ){
						var val = parseInt(this.target.value);
						if(this.target.value != "" &&  val !== 0){
							this.decreasing[this.namespace].push(val);
							this.target.value = "";
						}
					}
					this.create();
				}//EOF not parse mode
			}
			
			if(! this.parseMode){
				if(!this.target.value){
					this.target.value = element;
				}else{
					this.target.value += "," + element;
				}
				
				if(!this.multiple) this.hide();
				
	
				if(this.addCallBack) this.addCallBack();
			}//EOF not parse mode
		},
		switchAlias: function(){
			this.isAlias = this.isAlias ? 0 : 1;
			this.switchAliasNode.innerHTML = this.isAlias ?  this.switchAliasNode.getAttribute("question") : this.switchAliasNode.getAttribute("alias") ;
			var selectedNodes = dojo.query(".selectedElements");
			dojo.forEach(selectedNodes, function(node){
				if(FieldBalloon.isAlias){
					node.innerHTML = node.alias ? "{"+node.alias+"}" : node.question; 
				}else{
					node.innerHTML = node.question ?  node.question : "{"+node.alias+"}" ; 					
				}
			});
			this.create();
		},
		parse: function(){
			
			this.parseMode = 1;
			var inputs = dojo.query(".selectorinput");
			dojo.forEach(inputs, dojo.hitch(this,function(input){
				var value = input.value;
				if(value !== undefined && value != null && value !="" ){
					var name = input.getAttribute("name");
					var namespace = input.getAttribute("namespace");
					var allowed = input.getAttribute("allowed");
					allowed = (allowed === undefined) ? null : allowed;
					var multiple = parseInt(input.getAttribute("multiple"));
					this.show(name,namespace,multiple,allowed);
					if(multiIndexOf(value,",") != -1){
						var split = value.split(",");
						for(t in split){
							if( (typeof split[t] ) != "function" && (typeof split[t] ) != "object"  ){
								this.add(parseInt(split[t]));								
							}
						}
					}else{
						this.add(parseInt(value));
					}
				}
				
			}));

			this.parseMode = 0;
		}
}


var AliasBalloon = {
		node: null,
		contentNode: null,
		target: null,
		extended : 0,
		extendedOpt : ["{J_OPT_IN}", "{J_OPT_OUT}"],
		extendedUser : ["{J_USER_NAME}", "{J_USER_REALNAME}", "{J_USER_IP}"],
		addCallBack: null,
		removeCallBack: null,
		isEditor: 0,
		show: function(target,aliasSelectorButton,isExtended,isEditor){
				this.isEditor = isEditor;
				this.target = (!isEditor) ? dojo.byId("ATA_"+target) : target;
				
				this.extended = parseInt(isExtended);
				this.create();
				var bounds = _ViewportOffset(aliasSelectorButton,true); 
				var docScroll = _docScroll(aliasSelectorButton);
				bounds.t += docScroll.top -222;
				bounds.l += docScroll.left;
				dojo.style(this.node, {opacity:0, left: bounds.l+"px", top: bounds.t+"px"});
				dojo.fadeIn({
					node: this.node
				}).play();
		
		},
		hide: function(){
			dojo.fadeOut({
				node: this.node,
				onEnd: function(){
					dojo.style(AliasBalloon.node, {left: "-9999em"});
				}
			}).play();
		},
		create: function(){
			var content = "";
			
			if(this.extended > 1){

				if(this.extended != 2){
					var ol = this.extendedOpt.length;
					for(var t=0; t<ol ; t++){
						content += '<a onclick="javascript: AliasBalloon.add(\''+this.extendedOpt[t]+'\'); return false; ">' + this.extendedOpt[t] +'</a>';
					}
				}
				
				
				var xl = this.extendedUser.length;
				for(var t=0; t<xl ; t++){
					content += '<a onclick="javascript: AliasBalloon.add(\''+this.extendedUser[t]+'\'); return false; ">' + this.extendedUser[t] +'</a>';
				}				
			}
			
			var elements = eids;
			var l = elements.length;
			var fe = formElements;
			for(var t=0; t<l ; t++){
				var key = "_"+elements[t];
				
					if(fe[key].alias){ 	
						var title =  "{" + fe[key].alias + "}";
						if(title.length > 70){
							title = title.slice(0,67) + "...";
						}
						content += '<a onclick="javascript: AliasBalloon.add(\''+title+'\'); return false; ">' + title +'</a>';
					}
			}
			this.contentNode.innerHTML = content;
		},
		add: function(text){
			
			if(this.isEditor){
				if(typeof IeCursorFix == 'function'){
					IeCursorFix();
				}
				jInsertEditorText(text,this.target); 
			}else{
				var area = this.target;
				var start = area.selectionStart;
				
				if(dojo.isIE){
					var c = "\001",
				    	sel = document.selection.createRange(),
				    	dul = sel.duplicate(),
				    	len = 0;

					dul.moveToElementText(area);
					sel.text = c;
					len = dul.text.indexOf(c);
					sel.moveStart('character',-1);
					sel.text = "";
					start =  len;

				}
				
				
				area.value= area.value.substr(0, start) + text + area.value.substr(start, area.value.length);		
			}	
			return false;
		}
}



dojo.addOnLoad(function(){
	var balloon = dojo.byId("fieldBalloon");
	document.body.appendChild(balloon);
	FieldBalloon.node = balloon;
	FieldBalloon.contentNode = dojo.byId("fbContentNode");	
	FieldBalloon.switchAliasNode = dojo.byId("switchAliasNode");	
	dojo.style(balloon,{opacity : 1});
	dojo.connect(dojo.byId("fbBalloonClose"),"onclick",function(){ FieldBalloon.hide(); });
	FieldBalloon.parse();
	
	var aliasBalloon = dojo.byId("aliasBalloon");
	document.body.appendChild(aliasBalloon);
	AliasBalloon.node = aliasBalloon;
	AliasBalloon.contentNode = dojo.byId("aliasContentNode");	
	dojo.style(aliasBalloon,{opacity : 1});
	dojo.connect(dojo.byId("aliasBalloonClose"),"onclick",function(){ AliasBalloon.hide(); });
	
});

function appFormSubmit(){
	var eaCount = eAreas.length;
	if(eaCount != 0){
		for(t=0;t<eaCount; t++){
			eAL.toggle(eAreas[t]);
		}
	}	
	
	dojo.byId("appForm").submit();
	return true;	
}


