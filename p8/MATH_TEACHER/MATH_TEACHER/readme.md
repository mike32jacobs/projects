Submission:
This project is too large to submit via gradescope. I am sharing it with Logan via google drive.

Purpose:
The goal of this website is to become a place that math teachers can visit to
find solutions to some of the problems they face when creating content in a
digital environment. The first goal of the site is to teach math teachers how 
to display mathematical notation in a digital evironment. It can be difficult 
to get software to display mathematical content in an easily readable way. The
second goal of this site is to allow users to submit common problems faced by 
math teachers. This will be like a blog. Users submit problems and solutions. A 
third goal of this site is currently aspirational. I would like to create a 
place for math teachers to crowd-source question banks. I have not yet begun this work.


Favicon:
I used a favicon from an earlier project. And installed it in the layout page. It is very simple once it is created. 

CKEDITOR:
I wanted to add a field to my models which allows users to enter html, LaTex, text, and images. I have tried TINYMCE, but CKEditor is free, so I thought I would try it.  One source for installation instructions is https://github.com/django-ckeditor/django-ckeditor#django-ckeditor. Here is the official documentation.  I imported tichtextfield from ckeditor, and then used it for three fields. I had to also add it to my settings.py installed apps.

I also had to change the templates, so that they could safely display the html. For this, I used the |safe filter. To use the richtextfield in an html form.

This presented me with some problems. The tutorials that I watched were only 1 year old. But the newest version had some non-backwards-compatible upgrades. This was the notice: 

    "NOTICE: django-ckeditor 5 has backwards incompatible code moves against 4.5.1.

    File upload support has been moved to ckeditor_uploader. The urls are in ckeditor_uploader.urls, while for the file uploading widget you have to use RichTextUploadingField instead of RichTextField."

Eventually I added the following line to my settings.py file: "CKEDITOR_UPLOAD_PATH = "uploads/""
The next issue wit ckeditor was there was a 

Another issue that I ran into was a javascript console error when I loaded the form with the ckeditor. I got "[CKEDITOR] Error code: exportpdf-no-token-url"

Now I needed to go to https://ckeditor.com/docs/cs/latest/guides/easy-image/quick-start.html to figure out how to make adjustments.
Now it looks like that I need to pay for an account to get rid of this bug. I am going to just see if the bug can be ignored.CKEditor:


Migrations and Models:
I had trouble making migrations because I had not installed the AUTH_USER_MODEL = 'posts.User'

Mobile responsive
I accomplished this by using some bootstrap.css. In index.html, I used classes that are styled by bootstrap to make aspects of the page look good. For example, I have  div with the class "col-lg-4 col-md-4 mb-4". You can look through the index.html file to see some of the other classes. This was the key to making the page mobile friendly.  

sticky nav bar
In my first iteration, of this site, I struggled to get the navbar to be sticky. The text and links were sticky, but the favicon was not. This time around, I used .css rather than javascript to make it sticky. It was much easier, and the result it better.

HTML pages:
Layout.html is appplied to all html pages in the project. It includes the main navigation menu. it also includes the scrip for mathml and mathjax. These are very important for allowing the site to display mathematical notation. 

The other two ayouts, layout3 and layout4.html, include a side nav, and a standardized way to present some content related to math symbols. The standardized content includes latex.html, mathml.html, and mathjax.html. 

Two html pages that are nearly identical are problem_form.html, and problem_update_form.html. 

Two similar pages are problems2.html and problems.html. Problems2.html displays a list of problems. This list can be problems submitted by a particular user or all problems. The singular problem.html displays the a more-detailed view of the problem. In problem2.html I created a number of if-statements. Many of the fields are not required. The if-statements test to see if the field has data, and then renders the html.

forms.py
Thisfile creates a form that will be displayed in problem_form.html, and problem_update_form.html. I put a placeholder value for two of the fields. We did not do much with forms.py in the course, and I wanted to learn how to user them. I spent a lot of time working on this. It took some time to figure out how to set a placeholder, and how to render the form in html. Even more importantly, my views.py function uses the form to add and edit data. I am having trouble getting this to save to the database. Watched dozens of tutorials, and I can't figure out what is missing.


