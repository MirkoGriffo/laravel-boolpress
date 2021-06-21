require('./bootstrap');


//Delete post confirm

const delForm = document.querySelectorAll('.delete-post-form');
console.log(delForm);

delForm.forEach(form => {
    form.addEventListener('submit', function (e) {
        const resp = confirm('You really want to delete this post?');

        if (!resp) {
            e.preventDefault();
        }
    });
});