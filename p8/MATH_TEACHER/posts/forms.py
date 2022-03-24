from django import forms
from django.forms import fields

from .models import User, Problem

class ProblemForm(forms.ModelForm):
    short_description = forms.CharField(widget=forms.TextInput(attrs={"placeholder": "Less than 255 characters"}))
    image_url = forms.URLField(widget=forms.TextInput(attrs={"placeholder": "Associate an image with this post: Optional"}))

    class Meta:
        model = Problem
        fields = [
            'short_description',
            'image_url',
            'long_description',
            'video_example_url',
            'potential_solution',
            'solution_video_example_url',
            'takeaway'
        ]