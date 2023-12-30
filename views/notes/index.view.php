<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <ul class="list-disc text-gray-500">
            <?php foreach ($notes as $note) : ?>
                <li>
                    <a href="/note?id=<?= $note['id'] ?>" class="text-blue-500 hover:underline">
                        <?= htmlspecialchars($note['title']) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>

        <p class="mt-6">
            <a 
                class="inline-flex items-center px-5 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-white hover:bg-blue-600 focus:outline-none focus:ring focus:border-blue-700 active:bg-blue-800" 
                href="/notes/create" 
                >Create Note &raquo;</a>
        </p>

    </div>
</main>

<?php require base_path('views/partials/footer.php') ?>
