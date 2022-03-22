Purpose:
The goal of this website is to become a place that math teachers can visit to
find solutions to some of the problems they face when creating content in a
digital environment. It can be difficult to get software to display mathematical
content in an easily readable way. A second goal of this site is currently
aspirational. I would like to create a place for math teachers to crowd-source question
banks.

Understanding:
The structure of this web application will be familiar to CS50 section heads and
course heads. I used the same structure as pset9/finance, and added many features
to my web application.

Math folder

application.py
This file has some of the same functionaity as the file of the same name that was in
the pset9/finance web application. Those features are commented, and include configuring
flask, disables caching of responses, and configures flask to store sessions on the
local file system. It then configures CS50's SQL module to use problems.db.

The rest of the file contains routes for the web application. Note that login, logout,
and register are unchanged from the original. The most interesting thing you will
want to see is the /tryit route. In order to use this page, the user must be logged in.
If the user reaches this page on a GET, the default page is rendered, but if the user reaches
the page on a POST the page is rendered with user input.

helpers.py
You will find this file is essentially the same from the file of same name in the
pset9/finance. I did not need the USD filter, so I deleted it. I maintained the apology
and login functions. It is only now that I think that I could have easily included those functions
in application.py. However I am turning this in now, so I will save that change for
future versions of this site.

problems.db
This is the database which stores user information. It has one table called users.
The table has three fields: id, username, and hash.

snippet.txt
This file contains some mathml code and some latext code that you can use to copy and paste
into the application.


static folder

favicon.ico
This folder has the images used by the site when rendering pages. The most interesting
of which is the favicon.ico file. I used https://www.favicon.cc/ to generate this
image. Since it has to be so small, it can not have much detail, so I used a circle with
a triangle inside. This process took me way more time than I anticipated, and it made
me realize that I should study some more graphic design.

styles.css
This file contains the styles for some of the impartant features of the site. The navbar
and the sidenav attributes in this file hepled me change the look of the site. The colors
in the site are all colors of my favorite baseball team, the Kansas City Royals.

Templates folder.

Each html file in this folder had it's own challenges. I will explain some of these,
in this section as well as discuss the features.

layout.html, layout2.html, layout3.html, and layout4.html

Each of the pages on my site can essentially be put into one of these four layouts.
You will notice layout2.html extends layout.html. Layout3.html also extends layout.html,
and layout4.html extends layout3.html. This is something that I am quite proud of, but
I am also not going to be surprised if this type of setup is not conventional. I did it
this way because I want the top navbar to be on all pages of the site. The I actually
created two distinct sidenavs which both cover a subset of pages. One side nav for problems
has three links: Problem 1, Problem 2, and Problem 3. Another side nav has four links:
LaTex, mathml, mathjax, and try it.

Layout.html
The most important aspect of this file is the script to include mathjax. I explain this
on the site with lots of detail. This script allows all browsers to display mathml and
LaTex commands. Figuring out this seemingly simple script was probably the most important
thing that I learned throughout this project. In order to figure this out, I had to go down
a rabbit hole of laTex tutorials, and mathml tutorials, and now my understanding of the
relationship between these concepts has deepened dramatically.

layout2.html
This file extends layout.html. It has a sidenav with links to three pages. I wanted the
look of each of the problem pages to be the same, I created a division that acts as a template
to each problem page. This will allow me to easily create a new page when I want to add a new
problem. The jinja blocks on the page are assure that I include certain aspects
for each problem. I also included a class name and an idea for each section of
the template. This will allow me to use .css to change the look and feel of the
pages in the future. I did not implement anything in the stylesheet to take advantage
of this html, but I will in the future. Three pages extend this layout. They are:
problem1.html, problem2.html, and problem3.html.

layout3.html
This file extends layout.html. Essentially the only thing here is a sidenav, and a content block.
There is only 1 page in the site that uses this layout, and that is tryit.html.

layout4.html
This is an extension of layout3.html which is an extension of layout.html. This layout uses the sidenav
from layout3.html, and then creates a template for the pages which use the layout. I created the
html tags with class names and ids so that I could go back and format the site using .css stylesheets.
this template is essentially equivalent in look to the template in layout2.html. It is just applied
to a different subset of pages. The files that use this layout are latex.html, mathml.html, and mathjax.html.

tryit.html
The goal of this page is to create an editor in which the user can type LaTex code or mathml code,
and see how it will be rendered online. When the user reaches this page with a GET, the default
rendering of the page has no user input. When the user inputs code into the editor and hits the
submit button, a POST function is triggered, and the user's input is then used to display the mathematics.
This page presented a lot of challenges. I needed to install the tinymce editor, and change the default
menu items. Initially, there was no menu item which allowed the user to toggle bettween html and
wysiwyg. I was able to add that feature with a plugin. The long term version
of this will only include 1 tinymce menu item. The user will be able to enter wysiwyg
or html. Since the intent is for the user to type mathml or laTex commands, many of the
other features are not needed. I only leave them inlcuded now because I do not want
to break anything right before I submit.
Another challenge I faced in designing this page was that the html that the user
entered was not being displayed in the jumbotron as I intended. That html was being rendered
with the html tags, so the result was essentially just the html code. Professor Malan helped me
solve this problem by showing me that I could use a filter to escape the html. Notice that
the template contains the user content {{ userhtml|safe }}. The |safe allows the page to
actually generate that HTML. I intend to create snippets of code in both laTex and mathml
that the user can simply copy and paste into the editor, and then see how it is rendered.
The problem I am currently facing is that the code snippets are now actually being rendered
as math. This is essentially the opposite problem. I will definitely improve this for the future.

Overall, this has been agreat experience for me. The knowledge that I gained about LaTex, Mathml,
and MathJax is going to allow me to be way more efficient in my job. I borrow lots of
content from various sources, and use that content in my Canvas pages. Understanding these
concepts will save me so much heart ache.