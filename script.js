document.addEventListener('DOMContentLoaded', () => {
    const uploadPostForm = document.getElementById('uploadPostForm');
    const postList = document.getElementById('postList');

    let posts = [];

    uploadPostForm.addEventListener('submit', (e) => {
        e.preventDefault();

        const title = document.getElementById('postTitle').value;
        const content = document.getElementById('postContent').value;

        const newPost = {
            id: Date.now(),
            title,
            content,
        };

        posts.push(newPost);
        renderPosts();
        uploadPostForm.reset();
    });

    function renderPosts() {
        postList.innerHTML = '<h3>Existing Posts</h3>';
        posts.forEach((post) => {
            const postElement = document.createElement('div');
            postElement.classList.add('post');
            postElement.innerHTML = `
                <div>
                    <h4>${post.title}</h4>
                    <p>${post.content}</p>
                </div>
                <button onclick="deletePost(${post.id})">Delete</button>
            `;
            postList.appendChild(postElement);
        });
    }

    window.deletePost = (postId) => {
        posts = posts.filter(post => post.id !== postId);
        renderPosts();
    };
});
