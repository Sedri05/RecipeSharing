<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="scripts.js"></script>
    <link href="/reset.css" rel="stylesheet" />
    <link href="style.css" rel="stylesheet" />
</head>

<body>
    <div class="wrapper">
        <?php require("../header.php")?>
        <div class="container">
        <h2>Recipe Form</h2>
    <form id="recipeForm">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>

        <label for="picture">Picture:</label>
        <input type="file" id="picture" name="picture" accept="image/*" required>
        <br>
        <label for="tags">Tags:</label>
        <div class="tag-container" id="tagContainer">
            <input type="text" id="tags" name="tags" class="tagInput">
        </div>
        <button type="button" onclick="addTag()">Add Tag</button>

        <label for="ingredients">Ingredients:</label>
        <div class="tag-container" id="ingredientContainer">
            <input type="text" id="ingredients" name="ingredients" class="tagInput">
        </div>
        <button type="button" onclick="addIngredient()">Add Ingredient</button>

        <label for="instructions">Instructions:</label>
        <textarea id="instructions" name="instructions" rows="6" required></textarea>

        <label for="mealType">Meal Type:</label>
        <select id="mealType" name="mealType">
            <option value="dinner">Dinner</option>
            <option value="dessert">Dessert</option>
            <option value="lunch">Lunch</option>
            <option value="snack">Snack</option>
            <!-- Add more options as needed -->
        </select>

        <label for="prepTime">Prep Time (minutes):</label>
        <input type="number" id="prepTime" name="prepTime" min="0" required>

        <label for="difficulty">Difficulty (1-5):</label>
        <input type="number" id="difficulty" name="difficulty" min="1" max="5" required>

        <label for="servings">Servings:</label>
        <input type="number" id="servings" name="servings" min="1" required>

        <button type="submit">Submit</button>
    </form>
        </div>
    </div>
    <?php
    require("../footer.php")
    ?>
</body>

</html>