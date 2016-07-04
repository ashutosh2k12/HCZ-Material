(function() {
	
	tinymce.PluginManager.add('hczmc', function(editor, url) {
		editor.addButton('hczmc', {
			text : false,
			type : 'menubutton',
			icon : 'hcz-mc',
			classes: 'widget btn hczmc',
			menu : [ {
				text : 'HCZ Button',
				menu : [ {
					text : 'Primary button',
					menu : [ {
							text : 'Large button',
							onclick : function() {
									editor.insertContent('[mbtn class="btn btn-primary btn-raised btn-lg" text="Button Label" link="" icon="fa fa-home"]');
							}
						}, {
							text : 'Medium button',
							onclick : function() {
									editor.insertContent('[mbtn class="btn btn-primary btn-raised btn-md" text="Button Label" link="" icon="fa fa-home"]');
							}
						}, {
							text : 'Small button',
							onclick : function() {
									editor.insertContent('[mbtn class="btn btn-primary btn-raised btn-sm" text="Button Label" link="" icon="fa fa-home"]');
							}
						}, {
							text : 'Extra Small button',
							onclick : function() {
									editor.insertContent('[mbtn class="btn btn-primary btn-raised btn-xs" text="Button Label" link="" icon="fa fa-home"]');
							}
						}, ]
				}, {
					text : 'Warning button',
					menu : [ {
							text : 'Large button',
							onclick : function() {
									editor.insertContent('[mbtn class="btn btn-warning btn-raised btn-lg" text="Button Label" link="" icon="fa fa-home"]');
							}
						}, {
							text : 'Medium button',
							onclick : function() {
									editor.insertContent('[mbtn class="btn btn-warning btn-raised btn-md" text="Button Label" link="" icon="fa fa-home"]');
							}
						}, {
							text : 'Small button',
							onclick : function() {
									editor.insertContent('[mbtn class="btn btn-warning btn-raised btn-sm" text="Button Label" link="" icon="fa fa-home"]');
							}
						}, {
							text : 'Extra Small button',
							onclick : function() {
									editor.insertContent('[mbtn class="btn btn-warning btn-raised btn-xs" text="Button Label" link="" icon="fa fa-home"]');
							}
						}, ]
				}, {
					text : 'Error button',
					menu : [ {
							text : 'Large button',
							onclick : function() {
									editor.insertContent('[mbtn class="btn btn-danger btn-raised btn-lg" text="Button Label" link="" icon="fa fa-home"]');
							}
						}, {
							text : 'Medium button',
							onclick : function() {
									editor.insertContent('[mbtn class="btn btn-danger btn-raised btn-md" text="Button Label" link="" icon="fa fa-home"]');
							}
						}, {
							text : 'Small button',
							onclick : function() {
									editor.insertContent('[mbtn class="btn btn-danger btn-raised btn-sm" text="Button Label" link="" icon="fa fa-home"]');
							}
						}, {
							text : 'Extra Small button',
							onclick : function() {
									editor.insertContent('[mbtn class="btn btn-danger btn-raised btn-xs" text="Button Label" link="" icon="fa fa-home"]');
							}
						}, ]
				}, {
					text : 'Info button',
					menu : [ {
							text : 'Large button',
							onclick : function() {
									editor.insertContent('[mbtn class="btn btn-info btn-raised btn-lg" text="Button Label" link="" icon="fa fa-home"]');
							}
						}, {
							text : 'Medium button',
							onclick : function() {
									editor.insertContent('[mbtn class="btn btn-info btn-raised btn-md" text="Button Label" link="" icon="fa fa-home"]');
							}
						}, {
							text : 'Small button',
							onclick : function() {
									editor.insertContent('[mbtn class="btn btn-info btn-raised btn-sm" text="Button Label" link="" icon="fa fa-home"]');
							}
						}, {
							text : 'Extra Small button',
							onclick : function() {
									editor.insertContent('[mbtn class="btn btn-info btn-raised btn-xs" text="Button Label" link="" icon="fa fa-home"]');
							}
						}, ]
				}, {
					text : 'Normal Button',
					menu : [ {
							text : 'Large button',
							onclick : function() {
									editor.insertContent('[mbtn class="btn btn-normal btn-raised btn-lg" text="Button Label" link="" icon="fa fa-home"]');
							}
						}, {
							text : 'Medium button',
							onclick : function() {
									editor.insertContent('[mbtn class="btn btn-normal btn-raised btn-md" text="Button Label" link="" icon="fa fa-home"]');
							}
						}, {
							text : 'Small button',
							onclick : function() {
									editor.insertContent('[mbtn class="btn btn-normal btn-raised btn-sm" text="Button Label" link="" icon="fa fa-home"]');
							}
						}, {
							text : 'Extra Small button',
							onclick : function() {
									editor.insertContent('[mbtn class="btn btn-normal btn-raised btn-xs" text="Button Label" link="" icon="fa fa-home"]');
							}
						}, ]
				}, ]
			} ]

		});

	});
	
})();