app.definition = 
{
	"routes": {
		"default_route": {
			"everyone": "index/introduction",
			"user": "admin/manage_pages"	
		}
	},
	/*"search": {
		"search_type": "filter",
		"objects": [
		
		]	
	},*/
	"pages": [
		{
			"id": "introduction",
			"title": "Introduction",
			"title_append": true,
			"user_access": "everyone",
			"no_get_id": true,
			"content": [
				{
					"type": "content",
					"id": "introduction"
				}
			]
		},
		{
			"id": "admin",
			"title": "Manage web page",
			"user_access": 'user',
			"display_title": true,
			"content": [
				{
					"type": "frame",
					"id": "main",
					"default_page": "manage_pages"
				},
				{
					"type": "menu",
					"id": "admin_main",
					"position": "top",
					"target": "main",
					"content": [
						"manage_pages",
						"manage_publications",
						"manage_news",
						"manage_images",
						"manage_settings",
						"account"
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
					"form_action": "upload.php?action=images",
					"on_submit": [
						"images_list"
					]
				},
				{
					"type": "list",
					"id": "images",
					"image_location": "uploads",
					"target" : "main",
					"click": "edit_image",
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
						{
							"type": "text",
							"id": "description",
							"placeholder": "Description",
						},
						{
							"type": "text",
							"id": "description_2",
							"placeholder": "Description (Second Language)",
						}
					],
					"delete": true,
					"on_delete_navigate": "manage_images",
					"save": true,
					"get_load_mask": {
						"id": "id",
						"description": "description",
						"description_2": "description_2"	
					}
				}
			]
		},
		{
			"id": "manage_settings",
			"title": "Settings",
			"user_access": "admin",
			"content": [
				{
					"type": "form",
					"id": "settings",
					"title": "Settings",
					"peristant_values": true,
					"content": [
						{
							"type": "text",
							"id": "title",
							"placeholder": "Web Page Title"	
						},
						{
							"type": "textarea",
							"id": "description",
							"placeholder": "Web Page Description"	
						},
						{
							"type": "text",
							"id": "title_2",
							"placeholder": "Web Page Title (Second Language)"	
						},
						{
							"type": "textarea",
							"id": "description_2",
							"placeholder": "Web Page Description (Second Language)"	
						},
						{
							"type": "text",
							"id": "second_language",
							"placeholder": "Second Language"	
						},
						{
							"type": "text",
							"id": "url",
							"placeholder": "This Web Page URL"	
						},
						{
							"type": "text",
							"id": "orcid",
							"placeholder": "Orcid URL (Optional)",
							"optional_field": true	
						},
						{
							"type": "text",
							"id": "research_gate",
							"placeholder": "Research Gate URL (Optional)",
							"optional_field": true	
						},
						{
							"type": "text",
							"id": "facebook",
							"placeholder": "Facebook URL (Optional)",
							"optional_field": true	
						},
						{
							"type": "textarea",
							"rich_text": true,
							"id": "introduction",
							"placeholder": "Introduction"	
						},
						{
							"type": "textarea",
							"rich_text": true,
							"id": "introduction_2",
							"placeholder": "Introduction (Second Language)"	
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
			"id": "manage_news",
			"title": "News",
			"user_access": "admin",
			"content": [
				{
					"type": "content",
					"id": "desc",
					"content": "Here you can manage news."	
				},
				{
					"type": "form",
					"id": "news",
					"title": "New News Article",
					"new_on_save": true,
					"content": [
						{
							"type": "text",
							"id": "title",
							"placeholder": "News Title (English)"
						},
						{
							"type": "text",
							"id": "title_2",
							"placeholder": "News Title (Second Language)"
						},
						{
							"type": "textarea",
							"rich_text": true,
							"id": "content",
							"placeholder": "News Content (English)"
						},
						{
							"type": "textarea",
							"rich_text": true,
							"id": "content_2",
							"placeholder": "News Content (Second Language)"
						}
					],
					"save": true,
					"new": true,
					"on_submit": [
						"news_table"
					],
				},
				{
					"type": "content",
					"id": "file_upload_instructions",
					"content": "To add image to a news article: first save the news article then edit it and drop an image in the area below."
				},
				{
					"type": "file_upload",
					"id": "news_image",
					"form_action": "upload.php?action=news",
					"submit_mask": {
						"news_id": "news_form.id"	
					},
					"dependencies": [
						{
							"link": "news_form.id",
							"value": "set"
						}
					]	
				},
				{
					"type": "table",
					"id": "news",
					"edit": true,
					"delete": true,
					"search": true,
					"target": "news_form",
					"columns": {
						"title": "Title"
					},
					"column_width": {
						"title": "auto",
						"edit_button": "100px",
						"delete_button": "100px",
						"custom_action": "100px" 
					},
				},
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
					"content": "Here you can manage pages."	
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
							"placeholder": "Page Title (English)"
						},
						{
							"type": "text",
							"id": "title_2",
							"placeholder": "Page Title (Second Language)"
						},
						{
							"type": "textarea",
							"rich_text": true,
							"id": "content",
							"placeholder": "Page Content (English)"
						},
						{
							"type": "textarea",
							"rich_text": true,
							"id": "content_2",
							"placeholder": "Page Content (Second Language)"
						}
					],
					"save": true,
					"new": true,
					"on_submit": [
						"pages_table",
						"page_order_table"
					],
				},
				{
					"type": "table",
					"id": "pages",
					"edit": true,
					"delete": true,
					"search": true,
					"target": "page_form",
					"columns": {
						"title": "Title"
					},
					"column_width": {
						"title": "auto",
						"edit_button": "100px",
						"delete_button": "100px",
						"custom_action": "100px" 
					},
				},
				{
					"type": "title",
					"id": "reorder_table_title",
					"value": "Reorder Menu Buttons"
				},
				{
					"type": "table",
					"id": "page_order",
					"no_header": true,
					"drag_reorder": true,
					"columns": {
						"title": "Title"
					},
					"column_width": {
						"title": "auto",
						"drag": "25px"
					},
				},
			]
		},
		{
			"id": "account",
			"title": "Change Password",
			"user_access": "admin",
			"content": [
				{
					"type": "form",
					"id": "user",
					"title": "Change Account Password",
					"content": [
						{
							"type": "password",
							"id": "password",
							"placeholder": "Password"
						}
					],
					"save": true
				}
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
					"content": "Here you can manage publications. Edit publication category to add publication entries to that category. If a publication category contains no entries it will not be displayed on the web page."
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
							"placeholder": "Category Name (English)"
						},
						{
							"type": "text",
							"id": "category_name_2",
							"placeholder": "Category Name (Second Language)"
						},
					],
					"save": true,
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
					"target": "publication_category_form",
					"columns": {
						"category_name": "Category Name",
					},
					"column_width": {
						"category_name": "auto",
						"edit_button": "100px",
						"delete_button": "100px"
					}
				},
				{
					"type": "form",
					"id": "publication",
					"title": "New Publication",
					"content": [
						{
							"type": "textarea",
							"rich_text": true,
							"id": "publication",
							"placeholder": "Publication",
						},
						{
							"type": "date",
							"id": "created",
							"default_value": "Y-01-01"
						},
						{
							"type": "text",
							"id": "link",
							"placeholder": "Link",
							"optional_field": true
						},
						{
							"type": "select",
							"id": "category",
							"persist_value": true,
							"content": "fetch",
							"on_change": [
								"publications_table"	
							],
							"on_change_load_mask": {
								"id": "category_id"	
							}
						}
					],
					"save": true,
					"new": true,
					"on_submit": [
						"publications_table"
					],
					"on_load": [
						"publication_files_table"
					],
					"on_load_load_mask": {
						"id": "publication_id"	
					}	
				},
				{
					"type": "content",
					"id": "upload_instrucations",
					"content": "To upload files to publication: edit publication and drag files to area below."
				},
				{
					"type": "file_upload",
					"id": "publication_file",
					"form_action": "upload.php?action=publication",
					"submit_mask": {
						"publication_id": "publication_form.id"	
					},
					"dependencies": [
						{
							"link": "publication_form.id",
							"value": "set"
						}
					],
					"on_submit": [
						"publication_files_table"
					]	
				},
				{
					"type": "table",
					"id": "publication_files",
					"delete": true,
					"require_foreign_id": true,
					"columns": {
						"filename": "File Name",
					},
					"column_width": {
						"filename": "auto",
						"edit_button": "100px",
						"delete_button": "100px"
					},
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
					},
					"column_width": {
						"publication": "auto",
						"edit_button": "100px",
						"delete_button": "100px"
					},
				},
			]
		},
		{
			"id": "index",
			"title": "",
			"no_get_id": true,
			"title_link": "index/introduction",
			"icon": "sl_cv",
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
					"content": 'fetch'
				}
			]
		},
		{
			"id": "custom_page",
			"title": "",
			"user_access": "everyone",
			"content": [
				{
					"type": "title",
					"id": "title"				
				},
				{
					"type": "content",
					"id": "content"				
				}
			]
		},
		{
			"id": "images",
			"title": "Photos",
			"title_2": "Myndir",
			"user_access": "everyone",
			"content": [
				{
					"type": "list",
					"id": "images_display",
					"show_all_items": true,
					"image_location": "uploads",
					"target" : "main",
				}
			]
		},
		{
			"id": "publications",
			"title": "Publications",
			"title_2": "Ritaskrá",
			"user_access": "everyone",
			"no_get_data": true,
			"content": [
				{
					"type": "options",
					"id": "publication_categories",
					"target": "self",
					'load_mask': {
						"id": "category_id"
					},
					"content": "fetch"
				},
				{
					"type": "list",
					"id": "publications",
					"show_all_items": true,
					"search": "filter",
					"target" : "main",
					"columns": {
						"created": "Published",
						"link": "Available at"
					},
					"post_data": {
						"category_id": "category_id"
					},
					"default_values": {
						"category_id": "-1"
					}
				}
			]
		},
		{
			"id": "news",
			"title": "News",
			"title_2": "Fréttir",
			"click": "article",
			"animation": "slide",
			"content": [
				{
					"type": "list",
					"id": "news",
					//"search": "filter",
					"click": "article",
					"animation": "slide",
					"date_columns": [
						{	
							"class": "created",
							"popover": false,
							"time": false
						}
					],
					"image_location": "uploads",
					"columns": {
						"created": "Published"
					},
					"target" : "main",
				}
			]
		},
		{
			"id": "article",
			"class": "article",
			"click": "news",
			"animation": "slide",
			"content": [
				{
					"type": "title",
					"id": "title"
				},
				{
					"type": "date",
					"id": "created",
					"caption": "Published"
				},
				{
					"type": "content",
					"id": "content"	
				},
				{
					"type": "image",
					"id": "image",
					"image_location": "uploads"
				},
			]	
		},
	]
}
;