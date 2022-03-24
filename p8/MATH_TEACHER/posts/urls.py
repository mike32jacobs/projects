from django.urls import path

from . import views

urlpatterns = [
    path("", views.index, name="index"),
    path("login", views.login_view, name="login"),
    path("logout", views.logout_view, name="logout"),
    path("register", views.register, name="register"),
    path("problem/add", views.add_problem, name="add_problem"),
    path("problems", views.problems, name="problems"),
    path("problem/<int:problem_id>", views.problem, name="problem"),
    path("problem/<int:problem_id>/edit", views.edit_problem, name="edit_problem"),
    path("latex", views.latex, name="latex"),
    path("mathml", views.mathml, name="mathml"),
    path("mathjax", views.mathjax, name="mathjax"),
    path("mathsymbols", views.mathsymbols, name="mathsymbols"),
    path("user/<str:username>", views.user, name="user"),
    path("user/<str:username>/follow", views.follow, name="follow"),
    path("user/<str:username>/unfollow", views.unfollow, name="unfollow")
]