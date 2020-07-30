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
					"content": "fetch"
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
			"display_title": true,
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
						/*{
							"type": "textarea",
							"id": "description",
							"placeholder": "Page Description (English)"
						},
						{
							"type": "textarea",
							"id": "description_2",
							"placeholder": "Page Description (Second Language)"
						},*/
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
					/*"on_load": [
						"users_table",
						"user_form"
					],*/
					/*"on_load_load_mask": {
						"id": "user_group_id"	
					}*/	
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
					"dependencies": [	//gæti líka verið table með dependency a select, þannig að þegar selectid breytist breytist hverfur og birtist önnur tafla
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
						/*{
							"type": "textarea",
							"id": "description",
							"placeholder": "Page Description (English)"
						},
						{
							"type": "textarea",
							"id": "description_2",
							"placeholder": "Page Description (Second Language)"
						},*/
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
						/*{
							"type": "text",
							"id": "category_description",
							"placeholder": "Category description (English)",
							"optional_field": true
						},*/
						{
							"type": "text",
							"id": "category_name_2",
							"placeholder": "Category Name (Second Language)"
						},
						/*{
							"type": "text",
							"id": "category_description_2",
							"placeholder": "Category description (Second Language)",
							"optional_field": true
						}*/
					],
					"save": true,
					//"new": true,
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
						//"category_description": "Description"
					},
					"column_width": {
						"category_name": "auto",
						//"category_description": "auto",
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
							"rich_text": true,
							"id": "publication",
							"placeholder": "Publication",
							//"required_on_edit": false,
						},
						{
							"type": "date",
							"id": "created",
							"default_value": "Y-01-01"
							//"required_on_edit": false
						},
						{
							"type": "text",
							"id": "link",
							"placeholder": "Link",
							//"required_on_edit": false,
							"optional_field": true
						},
						/*{
							"type": "hidden",
							"id": "category_id",
							//"required_on_edit": true,
							"persist_value": true
						}*/,
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
							/*"dependencies": [	//gæti líka verið table með dependency a select, þannig að þegar selectid breytist breytist hverfur og birtist önnur tafla
								{
									"link": "article_form.content_type",
									"value": "1"
								}
							]*/	
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
					"type": "table",
					"id": "publications",
					"edit": true,
					"delete": true,
					"target": "publication_form",
					"require_foreign_id": true,
					"search": true,
					"columns": {
						"publication": "Publication",
						//"created": "Date",
					},
					"column_width": {
						"publication": "auto",
						"edit_button": "100px",
						"delete_button": "100px"
					},
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
					"dependencies": [	//gæti líka verið table með dependency a select, þannig að þegar selectid breytist breytist hverfur og birtist önnur tafla
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
					//"edit": true,
					"delete": true,
					//"target": "publication_form",
					"require_foreign_id": true,
					"search": true,
					"columns": {
						"filename": "File Name",
						//"created": "Date",
					},
					"column_width": {
						"filename": "auto",
						"edit_button": "100px",
						"delete_button": "100px"
					},
				},
			]
		},
		{
			"id": "index",
			"title": "Loading",
			"no_get_id": true,
			"title_link": "index/introduction",
			"icon": "sl_cv",
			"user_access": "everyone",
			//"user_menu": false,
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
			"title": "Loading",
			"user_access": "everyone",
			"content": [
				{
					"type": "title",
					"id": "title"				
				},
				/*{
					"type": "content",
					"id": "description"				
				},*/
				{
					"type": "content",
					"id": "content"				
				}
			]
		},
		/*{
			"id": "news",
			"title": "News",
			"user_access": "everyone",
			"content": [
				{
					"type": "content",
					"id": "description",
					"content": "News"				
				}
			]
		},*/
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
					//"search": "filter"
					//"click": "article",
					//"animation": "slide",
					/*"date_columns": [
						"created"
					],*/
					"image_location": "uploads",
					"target" : "main",
					//"click": "edit_image",
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
					//"click": "article",
					//"animation": "slide",
					/*"date_columns": [
						"created"
					],
					"content": {
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
			"id": "news",
			"title": "News",
			"title_2": "Fréttir",
			"click": "article",
			"animation": "slide",
			"content": [
				/*{
					"type": "carousel",
					"id": "news",
					"height": "400px",
					"time_interval": 7000,
					"play": true,
					"offset": 0,
					"animation": "slide",
					"bulbs": true
				},*/
				{
					"type": "list",
					"id": "news",
					//"search": "filter",
					"click": "article",
					"animation": "slide",
					"date_columns": [
						"created"
					],
					"image_location": "uploads",
					"columns": {
						"created": "Published"
					},
					"target" : "main",
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
				/*{
					"type": "user",
					"id": "user",
					"caption": "Submitted by"
				},*/
				{
					"type": "content",
					"id": "content"	
				},
				{
					"type": "image",
					"id": "image",
					"image_location": "uploads"
				},
				/*{
					"type": "tags",
					"id": "keywords",
					"caption": "Keywords"	
				},
				/*{
					"type": "comments"
				},*/
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