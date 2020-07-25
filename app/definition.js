app.definition = 
{
	"routes": {
		"default_route": {
			"everyone": "index/introduction",
			"user": "admin/manage_pages"	
		}
	},
	"search": {
		"search_type": "filter",
		"objects": [
		
		]	
	},
	"pages": [
		{
			"id": "introduction",
			"title": "Introduction",
			"title_append": true,
			"user_access": "everyone",
			"content": [
				{
					"type": "content",
					"id": "introduction",
					"content": "Welcome to this webpage"
				}
			]
		},
		/*{
			"id": "sign_up",
			"title": "Sign Up",
			"user_access": "everyone",
			"content": [
				{
					"type": "form",
					"id": "user",
					"title": "Create Account",
					"content": [
						{
							"type": "text",
							"id": "email",
							"validation": true,
							"placeholder": "Email (username)"
						},
						{
							"type": "password",
							"id": "password",
							"placeholder": "Password"
						}
					],
					"save": true,
					"redirect": "/account/"
				},
				{
					"type": "content",
					"id": "instructions",
					"content": "Your Noob account gives you access to the Noob Support page and Noob web applications. <!--The account is free.<br><br>Noob web applications include NumEval and NumRand.-->"	
				}
			]	
		},*/
		{
			"id": "admin",
			"title": "Manage web page",
			"user_access": 'user',
			"content": [
				{
					"type": "frame",
					"id": "main",
				},
				{
					"type": "menu",
					"id": "admin_main",
					"position": "top",
					"target": "main",
					"content": [
						"manage_pages",
						"manage_publications",
						"manage_settings",
						"manage_images"
					]
				}
			]
		},
		{
			"id": "manage_images",
			"title": "Images",
			"user_accecss": "admin",
			"content": [
				{
					"type": "content",
					"id": "instructions",
					"content": "Here you can upload and delete images."				
				},
				{
					"type": "file_upload",	
					"on_submit": [
						"images_list"
					]
				},
				{
					"type": "list",
					"id": "images",
					//"search": "filter"
					//"click": "article",
					//"animation": "slide",
					/*"date_columns": [
						"created"
					],*/
					"image_location": "uploads",
					"target" : "main",
					"click": "edit_image",
					//"animation": "slide",
					/*"edit": true,
					"edit_fields": [
						"description"
					],
					"delete": true,
					/*"content": {
						"username": {
							"target": "main"	
						},
						"keywords": {
								
						}
					}*/
				}
			]
		},
		{
			"id": "edit_image",
			"title": "Edit Image",
			"user_accecss": "admin",
			"content": [
				{
					"type": "form",
					"id": "image",
					"title": "Edit Image Description",
					"content": [
						/*{
							"type": "hidden",
							"id": "id"
						},*/
						{
							"type": "text",
							"id": "description",
							"placeholder": "Description",
						}
					],
					"delete": true,
					"on_delete_navigate": "manage_images",
					"save": true,
					"get_load_mask": {
						"id": "id",
						"description": "description"	
					}
				}
			]
		},
		{
			"id": "manage_settings",
			"title": "Settings",
			"user_accecss": "admin",
			"content": [
				{
					"type": "form",
					"id": "settings",
					"title": "Settings",
					"content": [
						{
							"type": "text",
							"id": "title",
							"placeholder": "Web Page Title"	
						},
						{
							"type": "text",
							"id": "first_language",
							"placeholder": "First Language"	
						},
						{
							"type": "text",
							"id": "second_language",
							"placeholder": "Second Language"	
						}
					],
					"save": true
				},
				{
					"type": "content",
					"id": "language_instruction",
					"content": "The language flag images can be changed by replacing first_language.png and second_language.png located in the images folder"	
				}
			]
		},
		{
			"id": "manage_pages",
			"title": "Pages",
			"user_access": "admin",
			"content": [
				{
					"type": "content",
					"id": "desc",
					"content": "Here you manage pages."	
				},
				{
					"type": "form",
					"id": "page",
					"title": "New Page",
					"new_on_save": true,
					"content": [
						{
							"type": "text",
							"id": "title",
							"placeholder": "Page Title (First Language)"
						},
						{
							"type": "text",
							"id": "title_2",
							"placeholder": "Page Title (Second Language)"
						},
						{
							"type": "text",
							"id": "description",
							"placeholder": "Page Description (First Language)"
						},
						{
							"type": "text",
							"id": "description_2",
							"placeholder": "Page Description (Second Language)"
						},
						{
							"type": "textarea",
							"id": "content",
							"placeholder": "Page Content (First Language)"
						},
						{
							"type": "textarea",
							"id": "content_2",
							"placeholder": "Page Content (Second Language)"
						}
					],
					"save": true,
					"new": true,
					"on_submit": [
						"pages_table"
					],
					/*"on_load": [
						"users_table",
						"user_form"
					],*/
					/*"on_load_load_mask": {
						"id": "user_group_id"	
					}*/	
				},
				{
					"type": "table",
					"id": "pages",
					"edit": true,
					"delete": true,
					"search": true,
					"target": "page_form",
					"columns": {
						"title": "Title",
						"description": "Description"
					},
					"column_width": {
						"title": "auto",
						"edit_button": "100px",
						"delete_button": "100px",
						"custom_action": "100px" 
					},
					/*"custom_actions": {
						"view": {
							"target_href": "stats",
							"href_data": {
								"user_group_id": "id"
							}
						}
					}*/
				},
			]
		},
		{
			"id": "manage_publications",
			"title": "Publications",
			"user_access": "admin",
			"content": [
				{
					"type": "content",
					"id": "instructions",
					"content": "Here you can manage publications. Edit publication category to add publication entries to that category."
				},
				{
					"type": "form",
					"id": "publication_category",
					"title": "New Publication Category",
					"new_on_save": true,
					"content": [
						{
							"type": "text",
							"id": "category_name",
							"placeholder": "Category Name"
						},
						{
							"type": "text",
							"id": "category_description",
							"placeholder": "Category description"
						}
					],
					"save": true,
					"new": true,
					"on_submit": [
						"publication_categories_table"
					],
					"on_load": [
						"publications_table",
						"publication_form"
					],
					"on_load_load_mask": {
						"id": "category_id"	
					}
				},
				{
					"type": "table",
					"id": "publication_categories",
					"edit": true,
					"delete": true,
					//"search": true,
					"target": "publication_category_form",
					"columns": {
						"category_name": "Category Name",
						"category_description": "Description"
					},
					"column_width": {
						"category_name": "auto",
						"category_description": "auto",
						"edit_button": "100px",
						"delete_button": "100px"
					}
				},
				{
					"type": "form",
					"id": "publication",
					"title": "New Publication",
					"new_on_save": true,
					"content": [
						{
							"type": "textarea",
							"id": "publication",
							"placeholder": "Publication",
							"required_on_edit": false,
						},
						{
							"type": "date",
							"id": "created",
							"required_on_edit": false
						},
						{
							"type": "text",
							"id": "link",
							"placeholder": "Link",
							"required_on_edit": false,
						},
						{
							"type": "hidden",
							"id": "category_id",
							"required_on_edit": true,
							"persist_value": true
						}
					],
					"save": true,
					"new": true,
					"on_submit": [
						"publications_table"
					]	
				},
				{
					"type": "table",
					"id": "publications",
					"edit": true,
					"delete": true,
					"target": "publication_form",
					"require_foreign_id": true,
					"search": true,
					"columns": {
						"publication": "Publication",
						"created": "Date",
					},
					"column_width": {
						"publication": "auto",
						"edit_button": "100px",
						"delete_button": "100px"
					},
				}
			]
		},
		{
			"id": "index",
			"title": "My CV Webpage",
			
			"icon": "icon.png",
			"user_access": "everyone",
			"content": [
				{
					"type": "frame",
					"id": "main",
				},
				{
					"type": "menu",
					"id": "index_main",
					"position": "top",
					"target": "main",
					"content": [
						"cv",
					]
				}
			]
		},
		{
			"id": "cv",
			"title": "CV",
			"user_access": "everyone",
			"content": [
				/*{
					"type": "content",
					"id": "instructions",
					"content": "Here you can find Noob applications and libraries to download."
				},*/
				/*{
					"type": "table",
					"id": "downloads",
					"title": "Downloads",
					"columns": {
						"image": "",
						"title": "Download",
						"description": "Description"
					},
					"content": {
						"image": "image"
					},
					"column_width": {
						"image": "50px",
						"title": "300px",
						"description": "auto"	
					},
					"target_frame": "main"
				}*/
			]
		},
		/*{
			"id": "account",
			"title": "Account",
			"click": "feature_request",
			"animation": "slide",
			"content": [
				{
					"type": "form",
					"id": "user",
					"title": "Change Password",
					"content": [
						{
							"type": "password",
							"id": "password",
							"placeholder": "Password"
						}
					],
					"save": true,	
				},
			]	
		},
		{
			"id": "applications",
			"title": "Applications",
			"user_access": "everyone",
			"content": [
				{
					"type": "content",
					"id": "instructions",
					"content": "Here you find Noob Web Applications"
				},
				{
					"type": "table",
					"id": "web_applications",
					"title": "Web Applications",
					"columns": {
						"image": "",
						"title": "Application",
						"description": "Description"
					},
					"content": {
						"image": "image"
					},
					"column_width": {
						"image": "50px",
						"title": "300px",
						"description": "auto"	
					},
					"target_frame": "main"
				}
			]
		}*/
	]
}
;