// The foundation of this javascript file came from the staff solution for CSCI-33 Network Project

document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('.heart').forEach(heart => {
    heart.addEventListener('click', () => updateLike(heart));
  });
  document.querySelectorAll('.liked').forEach(heart => {
    heart.addEventListener('click', () => updateLike(heart, false));
  });

  document.querySelectorAll('.edit').forEach(edit => {
    edit.addEventListener('click', function() {
      const problemId = edit.dataset.post;
      const area = document.querySelector(`.edit-area[data-post="${problemId}"]`);
      const button = document.querySelector(`.edit[data-post="${problemId}"]`);
      const content = document.querySelector(`.post-content[data-post="${problemId}"]`);

      if (button.innerHTML === 'Edit') {
        area.value = content.innerHTML;
        area.style.display = 'block';
        content.style.display = 'none';
        button.innerHTML = 'Save';
      } else {
        const token = document.querySelector('input[name="csrfmiddlewaretoken"]').value;
        fetch(`/posts/${problemId}/edit`, {
          method: 'PUT',
          body: JSON.stringify({
            content: area.value
          }),
          headers: {
            "X-CSRFToken": token
          }
        })
        .then(response => response.json())
        .then(data => {
          content.innerHTML = data.content;
          area.style.display = 'none';
          content.style.display = 'block';
          button.innerHTML = 'Edit';
        });
      }
    })
  });
});

function updateLike(heart) {
  const problemId = heart.dataset.post;
  const token = document.querySelector('input[name="csrfmiddlewaretoken"]').value;
  const like = heart.dataset.like === "1" ? false : true;
  fetch(`/problem/${problemId}`, {
    method: 'PUT',
    body: JSON.stringify({
      like: like
    }),
    headers: {
      "X-CSRFToken": token
    }
  })
  .then(response => response.json())
  .then(data => {
    if (like) {
      heart.classList.remove("not-liked");
      heart.classList.add("liked");
      heart.dataset.like = "1";
    } else {
      heart.classList.remove("liked");
      heart.classList.add("not-liked");
      heart.dataset.like = "0";
    }
    document.querySelector(`.like-count[data-post="${problemId}"]`).innerHTML = data.likes;
  });
}