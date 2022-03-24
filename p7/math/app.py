import os

from cs50 import SQL
from flask import Flask, flash, redirect, render_template, request, session
from flask_session import Session
from tempfile import mkdtemp
from werkzeug.exceptions import default_exceptions, HTTPException, InternalServerError
from werkzeug.security import check_password_hash, generate_password_hash

from helpers import apology, login_required

# Configure application
app = Flask(__name__)

# Ensure templates are auto-reloaded
app.config["TEMPLATES_AUTO_RELOAD"] = True


# Ensure responses aren't cached
@app.after_request
def after_request(response):
    response.headers["Cache-Control"] = "no-cache, no-store, must-revalidate"
    response.headers["Expires"] = 0
    response.headers["Pragma"] = "no-cache"
    return response



# Configure session to use filesystem (instead of signed cookies)
app.config["SESSION_FILE_DIR"] = mkdtemp()
app.config["SESSION_PERMANENT"] = False
app.config["SESSION_TYPE"] = "filesystem"
Session(app)

# Configure CS50 Library to use SQLite database
db = SQL("sqlite:///problems.db")


@app.route("/")
def index():
    """go to your home"""
    return render_template("index.html")

@app.route("/bank")
def bank():
    """This will eventually be created when I learn more about databases. Hopefully it will happen next year"""
    return apology("This aspect of the site is under construction", "Check back after the beet harvest")

@app.route("/issues")
def issues():
    """Show the Problems"""
    return render_template("problem1.html")

@app.route("/problem1")
def problem1():
    """Show the Problems"""
    return render_template("problem1.html")

@app.route("/problem2")
def problem2():
    """Show the Problems"""
    return render_template("problem2.html")

@app.route("/problem3")
def problem3():
    """Show the Problems"""
    return render_template("problem3.html")

@app.route("/symbols")
def symbols():
    """Show the Symbols"""
    return render_template("latex.html")

@app.route("/latex")
def latex():
    """Show the concept"""
    return render_template("latex.html")

@app.route("/mathml")
def mathml():
    """Show the concept"""
    return render_template("mathml.html")

@app.route("/mathjax")
def mathjax():
    """Show the concept"""
    return render_template("mathjax.html")

@app.route("/tryit", methods=["GET", "POST"])
@login_required
def tryit():
    """Give the user a tiny mcl editor """
    # User reached route via POST (as by submitting a form via POST)
    if request.method =="POST":
        userhtml = request.form.get("mytextarea")
        return render_template("tryit.html", userhtml=userhtml)

    # User reached route via GET (as by clicking a link or via redirect)
    else:
        return render_template("tryit.html")



@app.route("/login", methods=["GET", "POST"])
def login():
    """Log user in"""

    # Forget any user_id
    session.clear()

    # User reached route via POST (as by submitting a form via POST)
    if request.method == "POST":

        # Ensure username was submitted
        if not request.form.get("username"):
            return apology("must provide username", 403)

        # Ensure password was submitted
        elif not request.form.get("password"):
            return apology("must provide password", 403)

        # Query database for username
        rows = db.execute("SELECT * FROM users WHERE username = ?", request.form.get("username"))

        # Ensure username exists and password is correct
        if len(rows) != 1 or not check_password_hash(rows[0]["hash"], request.form.get("password")):
            return apology("invalid username and/or password", 403)

        # Remember which user has logged in
        session["user_id"] = rows[0]["id"]

        # Redirect user to home page
        return redirect("/")

    # User reached route via GET (as by clicking a link or via redirect)
    else:
        return render_template("login.html")


@app.route("/logout")
def logout():
    """Log user out"""

    # Forget any user_id
    session.clear()

    # Redirect user to login form
    return redirect("/")



@app.route("/register", methods=["GET", "POST"])
def register():
    """Register user"""
    if request.method == "POST":

       # Check that all fields were submitted
        # Ensure username was submitted
        if not request.form.get("username"):
            return apology("must provide username", 400)

        # Ensure password was submitted
        elif not request.form.get("password"):
            return apology("must provide password", 400)

        # Ensure confirmation was submitted
        elif not request.form.get("confirmation"):
            return apology("must provide password confirmation", 400)

        #Everything was submitted. Now check that submissions are valid

        # Query database for username
        rows = db.execute("SELECT * FROM users WHERE username = ?", request.form.get("username"))

        # if the query returns 1, then the username is already in use
        if len(rows) == 1:
            return apology("username unavailable", 400)

        # Check to see that the password matches the confirmation
        elif not ((request.form.get("password")) == request.form.get("confirmation")):
            return apology("passwords do not match", 400)
        else:
            #hash the pashword
            password_hash = generate_password_hash(request.form.get("password"))
            # Store the username (this just makes it easier to read the next function)
            username = request.form.get("username")

            #enter the username and password into the database
            db.execute("INSERT INTO users (username, hash) VALUES(?, ?)", username, password_hash)

        return redirect("/")

    # User reached route via GET (as by clicking a link or via redirect)
    else:
        return render_template("register.html")



def errorhandler(e):
    """Handle error"""
    if not isinstance(e, HTTPException):
        e = InternalServerError()
    return apology(e.name, e.code)


# Listen for errors
for code in default_exceptions:
    app.errorhandler(code)(errorhandler)
