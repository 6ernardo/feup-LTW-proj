<?php declare(strict_types = 1); ?>

<?php function drawFAQ(array $faqs) { ?>
    <h2>Frequently Asked Questions</h2>
    <p>You can't find an answer for your question here? Submit a ticket.</p>
    <dl>
        <?php foreach($faqs as $faq) { ?>
            <dt><?=$faq->question?></dt>
            <dd><?=$faq->answer?></dd>
        <?php } ?>
    </dl>
<?php } ?>

<?php function drawSubmitFAQ() { ?>
    <form action="../actions/action_submit_faq.php" method="POST">
        <input type="text" placeholder="Question" name="question" required>
        <textarea name="answer" placeholder="Answer" rows="5" cols="20" required></textarea>
        <button type="submit" name="submit_faq">Submit to FAQ</button>
    </form>
<?php } ?>