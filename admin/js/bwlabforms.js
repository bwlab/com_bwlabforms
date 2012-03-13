/* BWLabForms */

var editValue = null;

if (window.addEventListener){
	window.addEventListener("load",initPage,false);
} else if (window.attachEvent){ 
	var r = window.attachEvent("onload", initPage); 
} else {
	window.alert("Problem to add EventListener to Window Object !");  
}

function initPage() {
	initList('t_listRB','t_listHRB','t_valueRB','t_defaultRB');
	initList('t_listS','t_listHS','t_valueS','t_defaultS');
	//typeFieldChange();
	//typeFieldTextChange();
}

function addValueToList(elemlist,elemhidden,elemval,elemlab,elemcheck) {
	
	if ($chk($(elemlist)) && $chk($(elemhidden)) && $chk($(elemval)) && $chk($(elemlab)) && $chk($(elemcheck))) {
		
		var value = $(elemval).getProperty('value');
		var label = $(elemlab).getProperty('value');
		var check = 0;
				
		if (value != '') {

			value = value + "||" + label;
			if ($(elemcheck).checked) {
				value = value + ' [default]';
				check = 1;
				cleanOptions(elemlist);
			}
			
			if (editValue == null) {				
				addOption(elemlist,value,elemval,elemcheck);
			} else {
				if ($chk($(editValue))) {
					$(editValue).setProperty('value',value);
					$(editValue).setText(value);
					editValue = null;
				}
			}
			
			$(elemval).setProperty('value','');
			$(elemlab).setProperty('value','');
			$(elemcheck).checked = false;
			
			buildHiddenField(elemlist,elemhidden);
			
		} else {
			window.alert("Value field cannot be empty !");
		}
		
	} else {
		window.alert("addValueToList : Problem to retreive values ");
	}
}

function buildHiddenField(selectbox,elemhidden) {
	var selBox = $(selectbox);
	var elHid = $(elemhidden);
	
	if ($chk(selBox) && $chk(elHid)) {
		var value = "";
		for(var i=0;i<selBox.options.length;i++) {
			value = value + selBox.options[i].id+"=="+selBox.options[i].value;
			if (i<(selBox.options.length-1)) value = value +"[-]"; 
		}
		elHid.value = value;
	} else {
		window.alert("buildHiddenField : Problem to retreive values /n" + selectbox + " : " + elemhidden);
	}
}

function editValueList(elemlist,elemval,elemlab,elemcheck) {
	
	var elemlist=document.getElementById(elemlist);
	var elemval=document.getElementById(elemval);
	var elemlab=document.getElementById(elemlab);
	var elemcheck=document.getElementById(elemcheck);
	
	if (elemlist && elemval && elemlab && elemcheck) {
		
		var objSelected = elemlist.options[elemlist.selectedIndex];
		if (!objSelected) {
			window.alert("No options selected !");
			return false;
		}
		
		for(i=elemlist.options.length-1;i>=0;i--) {
			if(elemlist.options[i].selected) {
				var sep = elemlist.options[i].value.indexOf('||');
				var label = "";
				var value = "";
								
				if(index != -1) {
					value = elemlist.options[i].value.substring(0,sep); 
					label = elemlist.options[i].value.substring(sep+2); 
				}
				
				elemval.value = value;
				
				var index = label.indexOf(' [default]');
				if(index != -1) {
					elemlab.value = label.substring(0,index); 
					elemcheck.checked = true;
				} else {
					elemlab.value = label; 
					elemcheck.checked = false;
				}
				
				editValue = objSelected.id;
			}
		}
	} else {
		window.alert("editValueList : Problem to retreive values \n" +  elemlist + " : " + elemval + " : " + elemcheck);
	}
}

function resetValues(elemval,elemlab,elemcheck) {
	
	var elemval=document.getElementById(elemval);
	var elemlab=document.getElementById(elemlab);
	var elemcheck=document.getElementById(elemcheck);
	
	if (elemval && elemlab && elemcheck) {
		
		elemval.value = "";
		elemlab.value = "";
		elemcheck.checked = false;
		editValue = null;
	} else {
		window.alert("editValueList : Problem to retreive values \n" +  elemlist + " : " + elemval + " : " + elemcheck);
	}
}

function cleanOptions(selectbox) {
	var selBox = $(selectbox);
	
	if ($chk(selBox)) {
		for(var i=selBox.options.length-1;i>=0;i--) {
			var index = selBox.options[i].value.indexOf(' [default]');
			if(index != -1) {
				selBox.options[i].value = selBox.options[i].value.substring(0,index); 
				selBox.options[i].text = selBox.options[i].value;
			}
		}
	} else {
		window.alert("cleanOptions : Problem to retreive values \n" + selectbox);
	}
}

function addOption(selectbox,text,elemval,elemcheck) {
	
	var selBox = $(selectbox);
	var optn = document.createElement("OPTION");
	
	optn.text = text;
	optn.value = text;
	optn.id = "optrb" + selBox.options.length;
	
	selBox.options.add(optn);	
}

function test() {
	window.alert("Test OK");
}

function removeOptions(selectbox,elemhidden,elemval,elemlab,elemcheck) {
	var selectbox=document.getElementById(selectbox);
	var elemhidden=document.getElementById(elemhidden);
	
	var i;
	for(i=selectbox.options.length-1;i>=0;i--) {
		if(selectbox.options[i].selected)
			selectbox.remove(i);
	}
	
	// Rebuild IDs list
	for(i=0;i<selectbox.options.length;i++) {
		selectbox.options[i].id = "optrb" + i;
	}	
	
	buildHiddenField(selectbox,elemhidden);	
	
	resetValues(elemval,elemlab,elemcheck);
}

function initList(elemlist,elemhidden,elemval,elemlab,elemcheck) {
	var hiddenfield=document.getElementById(elemhidden);
	var selectbox=document.getElementById(elemlist);
	var elemval=document.getElementById(elemval);
	var elemlab=document.getElementById(elemlab);
	var elemcheck=document.getElementById(elemcheck);
	
	if (hiddenfield && selectbox ) {
		var pair=hiddenfield.value.split("[-]");
		for (var i=0; i<pair.length; i++) {
			var key=pair[i].split("==");
			if (key.length>1) {
				addOption(selectbox,key[1],elemval,elemlab,elemcheck);
			}
		}
		
		buildHiddenField(selectbox,hiddenfield);	
	} else {
		//window.alert("initListRB : Problem to retreive values \n" +  hiddenfield + " : " + selectbox);
	}	
}

function hiddeProperties() {
	
	$('ckf_text').setStyle('display','none');
	$('ckf_hidden').setStyle('display','none');
	$('ckf_textarea').setStyle('display','none');
	$('ckf_checkbox').setStyle('display','none');
	$('ckf_radiobutton').setStyle('display','none');
	$('ckf_select').setStyle('display','none');
	$('ckf_button').setStyle('display','none');
	$('ckf_fieldsep').setStyle('display','none');
	$('mandatory_row').setStyle('display','none');
	$('readonly_row').setStyle('display','none');
	$('custominfo_row').setStyle('display','none');
	$('customerror_row').setStyle('display','none');
	$('ckf_length').setStyle('display','none');

}

function typeFieldChange() {
	
	hiddeProperties();
	
	var ffield = 'ckf_' + $('typefield').getProperty('value');
	
	if (ffield != 'ckf_0') {
		$(ffield).setStyle('display','');
		
		if (ffield == "ckf_select" || ffield == "ckf_radiobutton" || ffield == "ckf_fileupload" || ffield == "ckf_checkbox"
			 || ffield == "ckf_text" || ffield == "ckf_textarea") {
			$('mandatory_row').setStyle('display','');
			$('custominfo_row').setStyle('display','');
			$('customerror_row').setStyle('display','');
			$('readonly_row').setStyle('display','');
		} 
		
		if (ffield != "ckf_hidden" && ffield != "ckf_checkbox" && ffield != "ckf_radiobutton" 
				&& ffield != "ckf_select" && ffield != "ckf_button" && ffield != "ckf_fileupload"
				 && ffield != "ckf_fieldsep") {
			$('ckf_length').setStyle('display','');
		}
	}

}

function hiddeTextProperties() {
	
	$('tdateformat_row').setStyle('display','none');
	$('tdateday_row').setStyle('display','none');
	$('tfillwithtext_row').setStyle('display','none');
}

function typeFieldTextChange() {
	
	hiddeTextProperties();
	
	var value = $('t_texttype').getProperty('value');
	
	if (value == 'date') {
		$('tdateformat_row').setStyle('display','');
		$('tdateday_row').setStyle('display','');
	} else if (value == 'text' || value == 'email') {
		$('tfillwithtext_row').setStyle('display','');
	}
	
}
