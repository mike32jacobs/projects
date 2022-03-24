from django.contrib import admin
from .models import User, Problem

# Register your models here.
admin.site.register(User),
admin.site.register(Problem)