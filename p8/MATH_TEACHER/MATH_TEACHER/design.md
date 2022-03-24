Favicon:
I used a favicon from an earlier project. And installed it in the layout page. It is very simple once it is created. 

CKEDITOR:
I wanted to add a field to my models which allows users to enter html, LaTex, text, and images. I have tried TINYMCE, but CKEditor is free, so I thought I would try it.  One source for installation instructions is https://github.com/django-ckeditor/django-ckeditor#django-ckeditor. Here is the official documentation.  I imported tichtextfield from ckeditor, and then used it for ttwo fields. I had to also edd it to my settings.py installed apps.
I also had to change the templates, so that they could safely display the html. For this, I used the |safe filter. To use the richtextfield in an html form, 

Another issue that I ran into was a javascript console error when I loaded the form with the ckeditor. I got "[CKEDITOR] Error code: exportpdf-no-token-url"
Now I needed to go to https://ckeditor.com/docs/cs/latest/guides/easy-image/quick-start.html to figure out how to make adjustments.
Now it looks like that I need to pay for an account to get rid of this bug. I am going to just see if the bug can be ignored.
