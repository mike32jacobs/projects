import json
from django.contrib.auth import authenticate, login, logout
from django.contrib.auth.decorators import login_required
from django.core.paginator import Paginator
from django.db import IntegrityError
from django.http import JsonResponse
from django.shortcuts import Http404, HttpResponse, HttpResponseRedirect, render, redirect
from django.urls import reverse
from django.views.decorators.csrf import csrf_exempt

from .models import User, Problem
from .forms import ProblemForm

# Function to return problem and like problem
@login_required
def problem(request,problem_id):
    try:
        problem = Problem.objects.get(pk=problem_id)
    except Problem.DoesNotExist:
        return JsonResponse({"error": "Problem not found."}, status=404)

    # Update whether problem is liked or not
    if request.method == "PUT":
        data = json.loads(request.body)
        like = bool(data.get("like"))
        if like:
            request.user.likes.add(problem)
        else:
            request.user.likes.remove(problem)
    print("mark 10: printing problem")
    print(problem)
    # return JsonResponse({
    #     "id": problem_id,
    #     "author": problem.author,
    #     "short_description": problem.short_description,
    #     "long_description": problem.long_description,
    #     "image_url": problem.image_url,
    #     "video_example_url": problem.video_example_url,
    #     "potential_solution": problem.potential_solution,
    #     "solution_video_example_url": problem.solution_video_example_url,
    #     "takeaway": problem.takeaway,
    #     "likes": problem.likes.count()
    # })    
    return render(request, "posts/problem.html", {'problem': problem})



# Function to add problems
@login_required
def add_problem(request):
    print("mark 3: inside of the add_problem")
    if request.method =="POST":
        form = ProblemForm(request.POST)
        if form.is_valid():
            problem_data =form.save(commit=False)
            problem_data.author=request.user
            problem_data.save()
            print("you saved the user data from the form.")
            print(problem_data)
            # For now, just send the user back to index. Update later
            return redirect("posts/index.html")
    else:
        print("mark 4: inside of the add_problem")

        form=ProblemForm()
    return render(request, "posts/problem_form.html", {'form': form})

# Function to edit problems
@login_required
def edit_problem(request,problem_id):
    problem=Problem.objects.get(id=problem_id)
    print("mark 1")
    print(problem_id)
    print(problem.short_description)
    form=ProblemForm(instance=problem)
    context ={'form':form, 'pk':problem.id}
    print("mark 2")
    print(context)
    print(problem.id)
    return render(request,"posts/problem_update_form.html", context)

def problems(request):
    problems = Problem.objects.order_by("-timestamp").all()
    print("mark 9: Printing Problems")
    print(problems)
    print(request)
    return show_problems("All Problems", request, problems)


@login_required
# This function came from the staff solution for CSCI-33 Network Project
def follow(request, username):
    if request.method == "POST":
        try:
            user = User.objects.get(username=username)
        except User.DoesNotExist:
            raise Http404("User does not exist.") 
        if user != request.user:
            user.followers.add(request.user)
    return HttpResponseRedirect(reverse("user", args=(username,)))


@login_required
# This function came from the staff solution for CSCI-33 Network Project
def following(request):
    problems = Problem.objects.filter(author__in=request.user.following.all()).order_by("-timestamp").all()
    return show_problems("Following", request, problems)



@login_required
# This function came from the staff solution for CSCI-33 Network Project

def unfollow(request, username):
    if request.method == "POST":
        try:
            user = User.objects.get(username=username)
        except User.DoesNotExist:
            raise Http404("User does not exist.") 
        if user != request.user:
            user.followers.remove(request.user)
    return HttpResponseRedirect(reverse("user", args=(username,)))

# Function to return all problems written by a user
# This function came from the staff solution for CSCI-33 Network Project

def user(request, username):
    try:
        user = User.objects.get(username=username)
    except User.DoesNotExist:
        raise Http404("User does not exist.")
    problems = Problem.objects.filter(author=user).order_by("-timestamp").all()
    return show_problems(user.username, request, problems, profile=user)

#  This function came from the staff solution for CSCI-33 Network Project
def show_problems(title, request, problems, profile=None):
    print("mark 11: I am inside of the show_problems function")
    # Get current page of problems
    page_index = request.GET.get("page", 1)
    paginator = Paginator(problems, 10)
    page = paginator.page(page_index)

    # Show problems page
    return render(request, "posts/problems2.html", {
        "title": title,
        "page": page,
        "profile": profile,
        # "show_new_problem": (
        #     request.user.is_authenticated and
        #     (profile is None or profile == request.user)
        # )
    })

def index(request):
    return render(request, "posts/index.html")

def latex(request):
    return render(request, "posts/latex.html")

def mathml(request):
    return render(request, "posts/mathml.html")

def mathjax(request):
    return render(request, "posts/mathjax.html")

def mathsymbols(request):
    return render(request, "posts/mathsymbols.html")

def login_view(request):
    if request.method == "POST":

        # Attempt to sign user in
        username = request.POST["username"]
        password = request.POST["password"]
        user = authenticate(request, username=username, password=password)

        # Check if authentication successful
        if user is not None:
            login(request, user)
            return HttpResponseRedirect(reverse("index"))
        else:
            return render(request, "posts/login.html", {
                "message": "Invalid email and/or password."
            })
    else:
        return render(request, "posts/login.html")


def logout_view(request):
    logout(request)
    return HttpResponseRedirect(reverse("index"))


def register(request):
    if request.method == "POST":
        username = request.POST["username"]
        email = request.POST["email"]

        # Ensure password matches confirmation
        password = request.POST["password"]
        confirmation = request.POST["confirmation"]
        if password != confirmation:
            return render(request, "posts/register.html", {
                "message": "Passwords must match."
            })

        # Attempt to create new user
        try:
            user = User.objects.create_user(username, email, password)
            user.save()
        except IntegrityError as e:
            print(e)
            return render(request, "posts/register.html", {
                "message": "Username already taken."
            })
        login(request, user)
        return HttpResponseRedirect(reverse("index"))
    else:
        return render(request, "posts/register.html")
