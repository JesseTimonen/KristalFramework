<?php
/**
 * Available variables:
 *  - $atts['request']
 *  - $atts['languages']
 */
?>

<ul class="language-menu navbar-nav justify-content-end">
    <?php foreach ($atts['languages'] as $language): ?>
        <li class="nav-item">
            <form method='post'>
                <?php CSRF::create($atts['request']); ?>
                <?php CSRF::request($atts['request']); ?>
                <button type='submit' name='language' value='<?= $language; ?>' class='btn btn-link p-0 border-0 bg-transparent'>
                    <img src="<?= image("Flags/$language.jpg"); ?>" class="change-language<?php if (Session::get("language") === $language) echo " active"; ?>" />
                </button>
            </form>
        </li>
    <?php endforeach; ?>
</ul>
