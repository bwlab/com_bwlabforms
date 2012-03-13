var mootabs = new Class({
	
	initialize: function(element, options) {
		this.options = Object.extend({
			changeTransition:	Fx.Transitions.bounceOut
		}, options || {});
		
		this.el = $(element);
		this.id = element;
		this.tabPanels = $$('#' + this.id + ' ul.mootabs_title');
		this.tabPanel = this.tabPanels[0];
		
		this.tabs = $$('#' + this.id + ' ul li a');
		
		
		this.tabs.each(function(tab) {
			tab.addEvent('click', function() {
				this.activate(tab);
			}.bind(this));
		}.bind(this));
		$$('#' + this.id + ' ul.mootabs_title').getFirst().addClass('active');
		$$('#' + this.id + ' div.mootabs_panel').getFirst().addClass('active');
	},
	
	activate: function(tab) {
		
		var linkName = tab.getProperty('href').split('#')[1];
		this.tabs.each(function(tab) {
			tab.removeClass('active');
		});
		tab.addClass('active');
		
		
		$$('#' + this.id + ' div.mootabs_panel').each(function(panel) {
			panel.removeClass('active');
		});
		
		
		$(linkName).addClass('active');
	},
	
	// public methods
	addTab: function(label, anchorname, content) {
		this.newTab = new Element('li');
		this.newPanel = new Element('div');
		
		this.newTab.setHTML('<a href="#' + anchorname + '">' + label + '</a>');
		this.newTab.addEvent('click', function() {
			this.activate(this.newTab.getFirst());
		}.bind(this));
		
		this.newPanel.id = anchorname;
		this.newPanel.addClass('mootabs_panel');

		this.newPanel.setHTML(content);
		
		this.newTab.injectInside(this.tabPanel);
		this.newPanel.injectInside(this.el);
		this.tabs = $$('#' + this.id + ' ul li a');
	},
	
	removeTab: function(tab) {
		this.tabToRemove = tab;
		
		$$('#' + this.id + ' ul.mootabs_title').getChildren()[0].each(function(tabLi) {
			if(tabLi.getFirst().getProperty('href') == '#' + this.tabToRemove)
			{
				tabLi.remove();
			}
		}.bind(this));
		
		$(this.tabToRemove).remove();
		this.tabs = $$('#' + this.id + ' ul li a');
		this.activate($$('#' + this.id + ' ul.mootabs_title').getChildren()[0][0].getFirst())
	},
	
	setActive: function(tabAnchor) {
		this.tabToActivate = tabAnchor;
		$$('#' + this.id + ' ul.mootabs_title').getChildren()[0].each(function(tabLi) {
			if(tabLi.getFirst().getProperty('href') == '#' + this.tabToActivate)
			{
				this.activate(tabLi.getFirst());
			}
		}.bind(this));
	}
	
});