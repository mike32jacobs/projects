from django.contrib.auth.models import AbstractUser
from django.db import models
from ckeditor_uploader.fields import RichTextUploadingField
from ckeditor.fields import RichTextField

class User(AbstractUser):
    following = models.ManyToManyField("User", related_name="followers")
    likes = models.ManyToManyField("Problem", related_name="likes")


class Problem(models.Model):
    author = models.ForeignKey("User", on_delete=models.CASCADE, related_name="problems")
    short_description = models.CharField(max_length=255)
    long_description = RichTextUploadingField(blank=True, null=True)
    image_url = models.URLField(blank=True, null=True)
    video_example_url=models.URLField(blank=True, null=True)
    potential_solution = RichTextUploadingField(blank=True, null=True)
    solution_video_example_url = models.URLField(blank=True, null=True)
    takeaway = RichTextUploadingField(blank=True, null=True)
    timestamp = models.DateTimeField(auto_now_add=True)
    archived = models.BooleanField(default=False)

    def serialize(self):
        return {
            "id": self.id,
            "author": self.author.username,
            "short_description": self.short_description,
            "long_description": self.long_description,
            "image_url": self.image_url,
            "video_example_url": self.video_example_url,
            "potential_solution": self.potential_solution,
            "solution_video_example_url": self.solution_video_example_url,
            "takeaway": self.takeaway,
            "timestamp": self.timestamp,
            "archived": self.archived
        }