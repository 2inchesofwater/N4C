// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// @license: Mad4Media Javascipt License - copyright Mad4Media - Fahrettin Kutyol - All rights reserved    ++
// (re-) publishing or forking for any purpose of commercial or non-commercial use is not allowed.		   ++
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


var ProformsAppMenu = {
		first: 0,
		app: null,
		jids: null,
		appSelect: null,
		init: function(){
	
			this.jids = dojo.byId("jform_request_jid");
			this.appSelect = dojo.byId("jform_request_app");
			
			var link = document.getElementsByName("link")[0].value;
		
			if(link.indexOf("app=") !== -1){
				var split = link.split("&app=");
				this.app = split[1];
				if(this.app.indexOf("&") !== -1){
					var split2 = this.app.split("&");
					this.app = split2[0];
				}
			}
			dojo.connect(this.jids, "onchange", function(){ProformsAppMenu.load(this.value);});
			this.load(this.jids.value);
			
		},
		
		load: function(jid){
			
			dojo.xhrGet({
			    url: "index.php?option=com_proforms&section=xhr&xhr=appmenu&jid="+jid,
			    handleAs : "json",
			    preventCache: true,
			    load: dojo.hitch(this,function(data){
			    	
			    	this.appSelect.innerHTML = data.inner;
			    	if(!this.first){
			    		console.log("first");
			    		this.first = 1;
			    		if(this.app){
			    			this.appSelect.value = this.app;
			    		}
			    	}
			    	
			    })
			});
			
			
		}		
}


dojo.addOnLoad(function(){ ProformsAppMenu.init();});