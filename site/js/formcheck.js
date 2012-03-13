/*
	Class: FormCheck
		Performs different tests on forms and indicates errors.
		
	Usage:
		Works with these types of fields :
		- input (text, radio, checkbox)
		- textarea
		- select
		
		You just need to add a specific class to each fields you want to check. 
		For example, if you add the class
			(code)
			validate['required','length[4, -1]','differs[email]','digit']
			(end code)
		the value's field must be set (required) with a minimum length of four chars (4, -1), 
		must differs of the input named email (differs[email]), and must be digit. 
		You can perform check during the datas entry or on the submit action, shows errors as tips or as div after the field, 
		show errors one by one or all together, show a list of all errors at the top of the form, localize error messages, add new regex check, ...
		The layout is design only with css. Now I added a hack to use transparent png with IE6, so you can use png images in formcheck.css (works only for theme) It can also works with multiple forms on a single html page.
		The class supports now internationalization. To use it, simply specify a new <script> element in your html page, like this : <script type="text/javascript" src="formcheck/lang/fr.js"></script>. N.B. : you must load this script before the formcheck and this method overpass the old way. You can create new languages following existing ones. You can otherwise still specifiy the alerts' strings when you initialize the Class, with options.
	
	Test type:
		You can perform various test on fields by addind them to the validate class. Be careful to *not use space chars*. Here is the list of them.
			
		required - The field becomes required. This is a regex, you can change it with class options.
		alpha - The value is restricted to alphabetic chars. This is a regex, you can change it with class options.
		alphanum - The value is restricted to alphanumeric characters only. This is a regex, you can change it with class options.
		nodigit - The field doesn't accept digit chars. This is a regex, you can change it with class options.
		digit - The value is restricted to digit (no floating point number) chars, you can pass two arguments (f.e. digit[21,65]) to limit the number between them. Use -1 as second argument to not set a maximum.
		number - The value is restricted to number, including floating point number. This is a regex, you can change it with class options.
		email - The value is restricted to valid email. This is a regex, you can change it with class options.
		phone - The value is restricted to phone chars. This is a regex, you can change it with class options.
		url: - The value is restricted to url. This is a regex, you can change it with class options.
		confirm - The value has to be the same as the one passed in argument. f.e. confirm[password].
		differs - The value has to be diferent as the one passed in argument. f.e. differs[user].
		length - The value length is restricted by argument (f.e. length[6,10]). Use -1 as second argument to not set a maximum.
		
	Parameters:
		When you initialize the class with addEvent, you can set some options. If you want to modify regex, you must do it in a hash, like for display or alert. You can also add new regex check method by adding the regex and an alert with the same name.
		
		Required :
			form_id - The id of the formular. This is required.
			
		Optional : 
			submitByAjax - you can set this to true if you want to submit your form with ajax. But the implementation is basic yet (on submit, a loader is shown, and then the response is displayed in a div centered over the form). By default it is false.
			tipsClass - The class to apply to tipboxes' errors. By default it is 'tipsbox'.
			errorClass - The class to apply to alertbox (not tips). By default it is 'error_f'.
			fieldErrorClass - The class to apply to fields with errors, except for radios. You should also turn on  options.addClassErrorToField.
		
		Display, this is a hash of display settings. in here you can modify :
			showErrors - 0 : onSubmit, 1 : onSubmit & onBlur, by default it is 1.
			errorsLocation - 1 : tips, 2 : before, 3 : after, by default it is 1.
			indicateErrors - 0 : none, 1 : one by one, 2 : all, by default it is 1.
			keepFocusOnError - 0 : normal behaviour, 1 : the current field keep the focus as it remain errors. By default it is 0.
			addClassErrorToField - 0 : no class is added to the field, 1 : the options.fieldErrorClass is added to the field with an error (except for radio).
			
			fixPngForIe - 0 : do nothing, 1 : fix png alpha for IE6 in formcheck.css. By default it is 1.
			replaceTipsEffect - 0 : No effect on tips replace when we resize the broswer, 1: tween transition on browser resize;
			closeTipsButton - 0 : the close button of the tipbox is hidden, 1 : the close button of the tipbox is visible. By default it is 1.
			flashTips - 0 : normal behaviour, 1 : the tipbox "flash" (disappear and reappear) if errors remain when the form is submitted. By default it is 0.
			tipsPosition - 'right' : the tips box is placed on the right part of the field, 'left' to place it on the left part. By default it is 'right'.
			tipsOffsetX - Horizontal position of the tips box (margin-left), , by default it is 100 (px).
			tipsOffsetY - Vertical position of the tips box (margin-bottom), , by default it is -10 (px).
			
			listErrorsAtTop - List all errors at the top of the form, , by default it is false.
			scrollToFirst - Smooth scroll the page to first error and focus on it, by default it is true.
			fadeDuration - Transition duration (in ms), by default it is 300.
		
		Alerts, This is a hash of alerts settings. in here you can modify strings to localize or wathever else. %0 and %1 represent the argument.
		
			required - "This field is required."
			alpha - "This field accepts alphabetic characters only."
			alphanum - "This field accepts alphanumeric characters only."
			nodigit - "No digits are accepted."
			digit - "Please enter a valid integer."
			digitmin - "The number must be at least %0"
			digitltd - "The value must be between %0 and %1"
			number - "Please enter a valid number."
			email - "Please enter a valid email: <br /><span>E.g. yourname@domain.com</span>"
			phone - "Please enter a valid phone."
			url - "Please enter a valid url: <br /><span>E.g. http://www.domain.com</span>"
			confirm - "This field is different from %0"
			differs - "This value must be different of %0"
			length_str - "The length is incorrect, it must be between %0 and %1"
			lengthmax - "The length is incorrect, it must be at max %0"
			lengthmin - "The length is incorrect, it must be at least %0"
			checkbox - "Please check the box"
			radios - "Please select a radio"
			select - "Please choose a value"
		
	Example:
		You can initialize a formcheck (no scroll, custom classes and alert) by adding for example this in your html head this code :
		
		(code)
		<script type="text/javascript">
			window.addEvent('domready', function() {
				var myCheck = new FormCheck('form_id', {
					tipsClass : 'tips_box',
					display : {
						scrollToFirst : false
					},
					alerts : {
						required : 'This field is ablolutely required! Please enter a value'
					}
				})
			});
		</script>
		(end code)
	
	About:
		formcheck.js v.1.4 for mootools v1.1 - 07 / 2008
		
		by Floor SA (http://www.floor.ch) MIT-style license
		
		Created by Luca Pillonel and David Mignot, last modified by Luca Pillonel 07.25.2008
	
*/

var FormCheck = new Class({
	
	options : {
		
		tipsClass: 'fc-tbx',				//tips error class
		errorClass: 'fc-error',				//div error class
		fieldErrorClass: 'fc-field-error',	//error class for elements
		
		submitByAjax : false,				//false : standard submit way, true : submit by ajax 
		
		display : {
			showErrors : 1,					//0 : onSubmit, 1 : onSubmit & onBlur
			errorsLocation : 1,				//1 : tips, 2 : before, 3 : after
			indicateErrors : 1,				//0 : none, 1 : one, 2 : all
			keepFocusOnError : 0,			//0 : normal behaviour, 1 : field keep the focus as it remain errors
			addClassErrorToField : 0,		//0 : normal behaviour, 1: a class (fieldErrorClass) is added to the field, to highlight it for example
			fixPngForIe : 1,				//0 : do nothing, 1 : fix png
			replaceTipsEffect : 1,			//0 : no effect on tips replace when we resize the window, 1: tween transition on window resize
			flashTips : 0,					//0 : desactivated, 1 : the tips is highlited if errors remains on submit.
			closeTipsButton : 1,			//0 : button is hidden, 1 : button is visible
			tipsPosition : "right",			//to place the tips on the left or on the right of the field
			tipsOffsetX : -45,				//Left position of the tips box (margin-left)
			tipsOffsetY : 0,				//Top position of the tips box (margin-bottom)
			listErrorsAtTop : false,		//list all errors at the top of the form
			scrollToFirst : true,			//Smooth scroll the page to first error
			fadeDuration : 300				//Transition duration
		},
		
		alerts : {
			required: "This field is required.",
			alpha: "This field accepts alphabetic characters only.",
			alphanum: "This field accepts alphanumeric characters only.",
			nodigit: "No digits are accepted.",
			digit: "Please enter a valid integer.",
			digitltd: "The value must be between %0 and %1",
			number: "Please enter a valid number.",
			email: "Please enter a valid email.",
			phone: "Please enter a valid phone.",
			url: "Please enter a valid url.",
			
			confirm: "This field is different from %0",
			differs: "This value must be different of %0",
			length_str: "The length is incorrect, it must be between %0 and %1",
			lengthmax: "The length is incorrect, it must be at max %0",
			lengthmin: "The length is incorrect, it must be at least %0",
			checkbox: "Please check the box",
			radios: "Please select a radio",
			select: "Please choose a value"
		},
		
		regexp : {
			required : /[^.*]/,
			alpha : /^[a-z ._-]+$/i,
			alphanum : /^[a-z0-9 ._-]+$/i,
			digit : /^[-+]?[0-9]+$/,
			nodigit : /^[^0-9]+$/,
			number : /^[-+]?\d*\.?\d+$/,
			email : /^[a-z0-9._%-]+@[a-z0-9.-]+\.[a-z]{2,4}$/i,
			phone : /^[\d\s ().-]+$/,
			url : /^(http|https|ftp)\:\/\/[a-z0-9\-\.]+\.[a-z]{2,3}(:[a-z0-9]*)?\/?([a-z0-9\-\._\?\,\'\/\\\+&amp;%\$#\=~])*$/i
		}
	},
	
	/*
	Constructor: initialize
		Constructor
	
		Add event on formular and perform some stuff, you now, like settings, ...
	*/
	initialize : function(form, options) {
		if (this.form = $(form)) {
			this.form.isValid = true;
			this.regex = ['length'];
			this.setOptions(options);
			
			//internalization
			if (typeof(formcheckLanguage) != 'undefined') this.options.alerts = formcheckLanguage;
			
			this.validations = [];
			this.alreadyIndicated = false;
			this.firstError = false;
			
			var regex = new Hash(this.options.regexp);
			regex.each(function(el, key) {
				this.regex.push(key);
			}, this)
	
			this.form.getElements("*[class*=validate]").each(function(el) {
				el.validation = [];
				var classes = el.getProperty("class").split(' ');
				classes.each(function(classX) {
					if(classX.match(/^validate(\[.+\])$/)) {
						var validators = eval(classX.match(/^validate(\[.+\])$/)[1]);
						for(var i = 0; i < validators.length; i++) {
							el.validation.push(validators[i]);
							//alert(validators[i]);
						}
						this.register(el);
					}
				}, this);
			}, this);
			
			//alert(this.validations);
			
			this.form.addEvents({
				"submit": this.onSubmit.bind(this)
			});
			
			//addEvent('click', function(cal) { this.toggle(cal); }.pass(cal, this)).injectAfter(cal.el);
			
			if(this.options.display.fixPngForIe) this.fixIeStuffs();
			document.addEvent('mousewheel', function(){
				this.isScrolling = false;
			}.bind(this));
		}
	},
	
	/*
	Function: register
		Private method
		
		Add listener on fields
	*/
	register : function(el) {
		this.validations.push(el);
		el.errors = [];
		if (el.validation[0] == 'submit') {
			el.addEvent('click', function(e){
				this.onSubmit(e);
			}.bind(this));
			return true;
		}

		if (this.isChildType(el) == false) el.addEvent('blur', function(e) {
			if(el.value) this.manageError(el, 'blur');
		}.bind(this))
		//We manage errors on radio
		else if (this.isChildType(el) == true) {
			
			//We get all radio from the same group and add a blur option
			var nlButtonGroup = $ES('input[name="'+ el.getProperty("name") +'"]', this.form);
			nlButtonGroup.each(function(el){
				el.addEvent('blur', function(){
					this.manageError(el, 'click');
				}.bind(this))
			},this);
		}
	},
	
	/*
	Function: validate
		Private method
		
		Dispatch check to other methods
	*/
	validate : function(el) {

		el.errors = [];
		el.isOk = true;
		//On valide l'lment qui n'est pas un radio ni checkbox
		el.validation.each(function(rule) {
			if(this.isChildType(el)) {
				if (this.validateGroup(el) == false) {
					el.isOk = false;
				}
			} else {
				var ruleArgs = [];
				if(rule.match(/^.+\[/)) {
					var ruleMethod = rule.split('[')[0];
					ruleArgs = eval(rule.match(/^.+(\[.+\])$/)[1].replace(/([A-Z\.]+)/i, "'$1'"));
				} else var ruleMethod = rule;
				
				if (this.regex.contains(ruleMethod) && el.getTag() != "select") {
					if (this.validateRegex(el, ruleMethod, ruleArgs) == false) {
						el.isOk = false;
					}
				}
				
				if (ruleMethod == 'confirm') {
					if (this.validateConfirm(el, ruleArgs) == false) {
						el.isOk = false;
					}
				}
				if (ruleMethod == 'differs') {
					if (this.validateDiffers(el, ruleArgs) == false) {
						el.isOk = false;
					}
				}
				if (el.getTag() == "select" || (el.type == "checkbox" && ruleMethod == 'required')) {
					if (this.simpleValidate(el) == false) {
						el.isOk = false;
					}
				}
			}
		}, this);
		
		if (el.isOk) return true;
		else return false;
	},
	
	/*
	Function: simpleValidate
		Private method
		
		Perform simple check for select fields and checkboxes
	*/
	simpleValidate : function(el) {	
		if (el.getTag() == 'select' && (el.selectedIndex == -1 || el.options[el.selectedIndex].value == '-1')) {
			el.errors.push(this.options.alerts.select);
			return false;
		} else if (el.type == "checkbox" && el.checked == false) {
			el.errors.push(this.options.alerts.checkbox);
			return false;
		}
		return true;
	},
	
	/*
	Function: validateRegex
		Private method
		
		Perform regex validations
	*/
	validateRegex : function(el, ruleMethod, ruleArgs) {
		var msg = "";
		if (ruleArgs[1] && ruleMethod == 'length') {
			if (ruleArgs[1] == -1) {
				this.options.regexp.length = new RegExp("^[\\s\\S]{"+ ruleArgs[0] +",}$");
				msg = this.options.alerts.lengthmin.replace("%0",ruleArgs[0]);
			} else {
				this.options.regexp.length = new RegExp("^[\\s\\S]{"+ ruleArgs[0] +","+ ruleArgs[1] +"}$");
				msg = this.options.alerts.length_str.replace("%0",ruleArgs[0]).replace("%1",ruleArgs[1]);
			}
		} else if (ruleArgs[0] && ruleMethod == 'length') {
			this.options.regexp.length = new RegExp("^.{0,"+ ruleArgs[0] +"}$");
			msg = this.options.alerts.lengthmax.replace("%0",ruleArgs[0]);
		} else {
			msg = this.options.alerts[ruleMethod];
		}
		
		if (ruleArgs[1] && ruleMethod == 'digit') {
			var regres = true;
			if (!this.options.regexp.digit.test(el.value)) {
				el.errors.push(this.options.alerts[ruleMethod]);
				regres = false;
			}
			if (ruleArgs[1] == -1) {
				if (el.value >= ruleArgs[0]) var valueres = true; else var valueres = false;
				msg = this.options.alerts.digitmin.replace("%0",ruleArgs[0]);
			} else {
				if (el.value >= ruleArgs[0] && el.value <= ruleArgs[1]) var valueres = true; else var valueres = false;
				msg = this.options.alerts.digitltd.replace("%0",ruleArgs[0]).replace("%1",ruleArgs[1]);
			}
			if (regres == false || valueres == false) {
				el.errors.push(msg);
				return false;
			}
		} else if (this.options.regexp[ruleMethod].test(el.value) == false)  {
			el.errors.push(msg);
			return false;
		}
		return true;
	},

	/*
	Function: validateConfirm
		Private method
		
		Perform confirm validations
	*/
	validateConfirm: function(el,ruleArgs) {
		if (el.validation.contains('required') == false) {
			el.validation.push('required');
		}
		var confirm = ruleArgs[0];
		if(el.value != this.form[confirm].value){
			msg = this.options.alerts.confirm.replace("%0",ruleArgs[0]);
			el.errors.push(msg);
			return false;
		}
		return true;
	},
	
	/*
	Function: validateDiffers
		Private method
		
		Perform differs validations
	*/
	validateDiffers: function(el,ruleArgs) {
		var confirm = ruleArgs[0];
		if(el.value == this.form[confirm].value){
			msg = this.options.alerts.differs.replace("%0",ruleArgs[0]);
			el.errors.push(msg);
			return false;
		}
		return true;
	},
	
	/*
	Function: isChildType
		Private method
		
		Determine if the field is a group of radio or not.
	*/
	isChildType: function(el) {
		var elType = el.type.toLowerCase();
		if((elType == "radio")) return true;
		return false;
	},
	
	/*
	Function: validateGroup
		Private method
		
		Perform radios validations
	*/
	validateGroup : function(el) {
		el.errors = [];
		var nlButtonGroup = this.form[el.getProperty("name")];
		el.group = nlButtonGroup;
		var cbCheckeds = false;
		
		for(var i = 0; i < nlButtonGroup.length; i++) {
			if(nlButtonGroup[i].checked) {
				cbCheckeds = true;
			}
		}
		if(cbCheckeds == false) {
			el.errors.push(this.options.alerts.radios);
			return false;
		} else {
			return true;	
		}
	},
	
	/*
	Function: listErrorsAtTop
		Private method
		
		Display errors
	*/
	listErrorsAtTop : function(obj) {
		if(!this.form.element) {
			 this.form.element = new Element('div', {'id' : 'errorlist', 'class' : this.options.errorClass}).injectTop(this.form);
		}
		if ($type(obj) == 'collection') {
			new Element('p').setHTML("<span>" + obj[0].name + " : </span>" + obj[0].errors[0]).injectInside(this.form.element);
		} else {
			if ((obj.validation.contains('required') && obj.errors.length > 0) || (obj.errors.length > 0 && obj.value && obj.validation.contains('required') == false)) {
				obj.errors.each(function(error) {
					new Element('p').setHTML("<span>" + obj.name + " : </span>" + error).injectInside(this.form.element);
				}, this);
			}
		}
	},
	
	/*
	Function: manageError
		Private method
		
		Manage display of errors boxes
	*/
	manageError : function(el, method) {
		var isValid = this.validate(el);
		if (((!isValid && el.validation.contains('required')) || (!el.validation.contains('required') && el.value && !isValid))) {
			if(this.options.display.listErrorsAtTop == true && method == 'submit')
				this.listErrorsAtTop(el, method);
			if (this.options.display.indicateErrors == 2 ||this.alreadyIndicated == false || el.name == this.alreadyIndicated.name)
			{
				if(!this.firstError) this.firstError = el;
				this.alreadyIndicated = el;
				if (this.options.display.keepFocusOnError && el.name == this.firstError.name) (function(){el.focus()}).delay(20);
				this.addError(el);
				return false;
			}
			
		} else if ((isValid || (!el.validation.contains('required') && !el.value)) && el.element) {
			this.removeError(el);
			return true;
		}
		return true;
	},
	
	/*
	Function: addError
		Private method
		
		Add error message
	*/
	addError : function(obj) {
		if((this.options.display.showErrors == 1 || method == 'submit' ) && (!obj.element && this.options.display.indicateErrors != 0)) {
			if (this.options.display.errorsLocation == 1) {
				var pos = (this.options.display.tipsPosition == 'left') ? obj.getCoordinates().left : obj.getCoordinates().right;
				var options = {
					'opacity' : 0,
					'position' : 'absolute',
					'float' : 'left',
					'left' : pos + this.options.display.tipsOffsetX
				}
				obj.element = new Element('div', {'class' : this.options.tipsClass, 'styles' : options}).injectInside(document.body);
				this.addPositionEvent(obj);
			} else if (this.options.display.errorsLocation == 2){
				obj.element = new Element('div', {'class' : this.options.errorClass, 'styles' : {'opacity' : 0}}).injectBefore(obj);
			} else if (this.options.display.errorsLocation == 3){
				obj.element = new Element('div', {'class' : this.options.errorClass, 'styles' : {'opacity' : 0}});
				if ($type(obj.group) == 'object' || $type(obj.group) == 'collection')
					obj.element.injectAfter(obj.group[obj.group.length-1]);
				else
					obj.element.injectAfter(obj);
			}
		}						
		if (obj.element) {
			obj.element.empty();
			if (this.options.display.errorsLocation == 1) {
				var errors = [];
				obj.errors.each(function(error) {
					errors.push(new Element('p').setHTML(error));
				});
				
/* PREVEST START */
				if ($chk($(obj)) && $chk($(obj.getProperty('id')))) {
					var customErrorEl = 'error'+obj.getProperty('id');
					if ($chk($(customErrorEl))) {
						var customErrorText = $(customErrorEl).getText();
						if (customErrorText != "") {
							errors = [];
							errors.push(new Element('p').setHTML(customErrorText));
						}
					}
				}
/* PREVEST END */				

				var tips = this.makeTips(errors).injectInside(obj.element);
				if(this.options.display.closeTipsButton) {
					$E('a.close', tips).addEvent('click', function(){
						this.removeError(obj);
					}.bind(this));
				}
				obj.element.setStyle('top', obj.getCoordinates().top - tips.getCoordinates().height + this.options.display.tipsOffsetY);
			} else {
				var errors = [];
				obj.errors.each(function(error) {
					errors.push(new Element('p').setHTML(error));
				});

/* PREVEST START */
				if ($chk($(obj)) && $chk($(obj.getProperty('id')))) {
					var customErrorEl = 'error'+obj.getProperty('id');
					if ($chk($(customErrorEl))) {
						var customErrorText = $(customErrorEl).getText();
						if (customErrorText != "") {
							errors = [];
							errors.push(new Element('p').setHTML(customErrorText));
						}
					}
				}
/* PREVEST END */				
				
				errors.each(function(error) {
					error.injectInside(obj.element);
				});
			}
			
			if (!window.ie7 && obj.element.getStyle('opacity') == 0)
				new Fx.Styles(obj.element, {'duration' : this.options.display.fadeDuration}).start({'opacity':[1]});
			else
				obj.element.setStyle('opacity', 1);
		}
		if (this.options.display.addClassErrorToField && this.isChildType(obj) == false)
		{
			obj.addClass(this.options.fieldErrorClass);
		}
	},
	
	
	/*
	Function: addPositionEvent
		
		Update tips position after a browser resize
	*/
	addPositionEvent : function(obj) {
		if(this.options.display.replaceTipsEffect) {
			window.addEvent('resize', function(){
				new Fx.Styles(obj.element, {
					'duration' : this.options.display.fadeDuration
				}).start({ 
					'left':[obj.element.getStyle('left'), obj.getCoordinates().right + this.options.display.tipsOffsetX],
					'top':[obj.element.getStyle('top'), obj.getCoordinates().top - obj.element.getCoordinates().height + this.options.display.tipsOffsetY]
				});
			}.bind(this));
		} else {
			window.addEvent('resize', function(){
				obj.element.setStyles({ 
					'left':obj.getCoordinates().right + this.options.display.tipsOffsetX,
					'top':obj.getCoordinates().top - obj.element.getCoordinates().height + this.options.display.tipsOffsetY
				});
			}.bind(this));
		}
	},
	
	
	/*
	Function: removeError
		Private method
		
		Remove the error display
	*/
	removeError : function(obj) {
		this.firstError = false;
		this.alreadyIndicated = false;
		obj.errors = [];
		obj.isOK = true;
		if (this.options.display.errorsLocation == 2)
			new Fx.Styles(obj.element, {'duration' : this.options.display.fadeDuration}).start({ 'height':[0] });
		if (!window.ie7) {
			new Fx.Styles(obj.element, {
				'duration' : this.options.display.fadeDuration,
				'onComplete' : function() {
					if (obj.element) {
						obj.element.remove();
						obj.element = false;
					}
				}.bind(this)
			}).start({ 'opacity':[1,0] });
		} else {
			obj.element.remove();
			obj.element = false;
		}
		
		if (this.options.display.addClassErrorToField && !this.isChildType(obj))
		{
			obj.removeClass(this.options.fieldErrorClass);
		}
	},
	
	/*
	Function: focusOnError
		Private method
		
		Create set the focus to the first field with an error if needed
	*/
	focusOnError : function (obj) {
		if (this.options.display.scrollToFirst && !this.alreadyFocused && !this.isScrolling) {
			if (this.alreadyIndicated.element) {
				switch (this.options.display.errorsLocation){
					case 1 : 
						var dest = obj.element.getCoordinates().top;
						break;
					case 2 :
						var dest = obj.element.getCoordinates().top-30;
						break;
					case 3 :
						var dest = obj.getCoordinates().top-30;
						break;
				}
				this.isScrolling = true;
			} else if (!this.options.display.indicateErrors) {
				var dest = obj.getCoordinates().top-30;
			}
			if (window.getSize().scroll.y != dest) {
				new Fx.Scroll(window, {
					onComplete : function() {
						this.isScrolling = false;
						obj.focus();
					}.bind(this)
				}).scrollTo(0,dest);
			} else {
				this.isScrolling = false;
				obj.focus();
			}
			this.alreadyFocused = true;
		}
	},
	
	/*
	Function: fixIeStuffs
		Private method
		
		Fix some png shits for IE...
	*/
	fixIeStuffs : function () {
		if (window.ie6) {
			//We fix png stuffs
			var rpng = new RegExp('url\\(([\.a-zA-Z0-9_/:-]+\.png)\\)');
			var search = new RegExp('(.+)formcheck\.css');
			for (var i = 0; i < document.styleSheets.length; i++){
				if (document.styleSheets[i].href.match(/formcheck\.css$/)) {
					var root = document.styleSheets[i].href.replace(search, '$1');
					var count = document.styleSheets[i].rules.length;
					for (var j = 0; j < count; j++){
						var cssstyle = document.styleSheets[i].rules[j].style;
						var bgimage = root + cssstyle.backgroundImage.replace(rpng, '$1');
						if (bgimage && bgimage.match(/\.png/i)){
							var scale = (cssstyle.backgroundRepeat == 'no-repeat') ? 'crop' : 'scale';
							cssstyle.filter =  'progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled=true, src=\'' + bgimage + '\', sizingMethod=\''+ scale +'\')';
							cssstyle.backgroundImage = "url('no-image')";
						}
					}
				}
			}
		}
	},
	
	/*
	Function: makeTips
		Private method
		
		Create tips boxes
	*/
	makeTips : function(txt) {
		
		var table = new Element('table');
			table.cellPadding ='0';
			table.cellSpacing ='0';
			table.border ='0';
			
			var tbody = new Element('tbody').injectInside(table);
				var tr1 = new Element('tr').injectInside(tbody);
					new Element('td', {'class' : 'tl'}).injectInside(tr1);
					new Element('td', {'class' : 't'}).injectInside(tr1);
					new Element('td', {'class' : 'tr'}).injectInside(tr1);
				var tr2 = new Element('tr').injectInside(tbody);
					new Element('td', {'class' : 'l'}).injectInside(tr2);
					var cont = new Element('td', {'class' : 'c'}).injectInside(tr2);
						var errors = new Element('div', {'class' : 'err'}).injectInside(cont);
						txt.each(function(error) {
							error.injectInside(errors);
						});
						if (this.options.display.closeTipsButton) new Element('a',{'class' : 'close'}).injectInside(cont);
					//	new Element('div', {'style' : "clear:both"}).injectInside(cont);
					new Element('td', {'class' : 'r'}).injectInside(tr2);
				var tr3 = new Element('tr').injectInside(tbody);
					new Element('td', {'class' : 'bl'}).injectInside(tr3);
					new Element('td', {'class' : 'b'}).injectInside(tr3);
					new Element('td', {'class' : 'br'}).injectInside(tr3);			
		return table;
	},
	
	/*
	Function: reinitialize
		Private method		
		
		Reinitialize form before submit check
	*/
	reinitialize: function() {
		this.validations.each(function(el) {
			if (el.element) {
				el.errors = [];
				el.isOK = true;
				if(this.options.display.flashTips == 1) {
					el.element.remove();
					el.element = false;
				}
			}
		}, this);
		if (this.form.element) this.form.element.empty();
		this.alreadyFocused = false;
		this.firstError = false;
		this.alreadyIndicated = false;
		this.form.isValid = true;
	},
	
	/*
	Function: submitByAjax
		Private method		
		
		Send the form by ajax, and replace the form with response
	*/
	submitByAjax: function() {
		var url = this.form.getProperty('action') + "?" + this.form.toQueryString();
		
		this.initLoader();
			
   		new Ajax(url, {
                method: 'get',
                onComplete: function(result){      
					//We put a message in the loader div
					this.loader.setStyle('background','none');
					this.loader.setHTML(result);
				}.bind(this)
        }).request();
	},
	
	/*
	Function: _makeWaitBox 
		Create a loader to wait the user
		
		Parameters:
			el - of the current form	
	*/
	initLoader : function() {
		el = this.form;
		el.setStyle('opacity','0.3');
		$ES('input, select, textarea', this.form).each(function(element){
			element.disabled = true;			
		});
		
		this.loader = new Element('div', { 'class' : "ajax_loader"}).injectAfter(el);
		var top = el.getCoordinates().top + (el.getCoordinates().height/2) - (this.loader.getCoordinates().height/2);
		var left =  el.getCoordinates().left  + (el.getCoordinates().width/2) - (this.loader.getCoordinates().width/2); 		
		this.loader.setStyles({
			'position': 'absolute',
			'top': top,
			'left': left 
		});
	},
	
	/*
	Function: onSubmit
		Private method		
		
		Perform check on submit action
	*/
	onSubmit: function(event) {
		new Event(event).stop();
		this.reinitialize();
				
		this.validations.each(function(el) {
			//alert(el.getProperty('name'));						   
			if(!this.manageError(el,'submit')) this.form.isValid = false;
		}, this);
		
		(this.form.isValid) ? (this.options.submitByAjax) ? this.submitByAjax() : this.form.submit() : this.focusOnError(this.firstError);
	}
});
FormCheck.implement(new Options());