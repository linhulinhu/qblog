<div class="commentinfo">
    <form action="add_gbook.php" method="post">
        <h3>发表评论</h3>
        <p>
            <label for="name">昵称:</label>
            <input name="name" id="name" type="text" required />
        </p>
        <p>
            <label for="email">邮箱:</label>
            <input name="email" id="email" type="email" required />
        </p>
        <p>
            <label for="website">主页:</label>
            <input name="url" id="website" type="url" />
        </p>
        <p>
            <label for="comment">评论</label>
            <textarea name="comment" id="comment" required></textarea>
        </p>
        <p><input type="submit" value="发表评论" /></p>
    </form>
</div>