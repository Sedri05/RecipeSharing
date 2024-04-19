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
        <h2>Nieuw recept maken:</h2>
        <form id="recipeForm">
            <label for="title">Titel:</label>
            <input id="title" name="title" required>

            <label for="picture">Voeg een foto toe:</label>
            <input id="picture" name="picture" accept="image/*" required>
            <br>
            <label for="tags">Tags:</label>
            <div class="tag-container" id="tagContainer">
                <input type="text" id="tags" name="tags" class="tagInput">
            </div>
            <button type="button" onclick="addTag()">Tag toevoegen</button>

            <label for="ingredients">Ingrediënten :</label>
            <div class="tag-container" id="ingredientContainer">
                <input type="text" id="ingredients" name="ingredients" class="tagInput">
            </div>
            <button type="button" onclick="addIngredient()">ingrediënt toevoegen</button>

            <label for="instructions">Bereiding:</label>
            <textarea id="instructions" name="instructions" rows="6" required></textarea>

            <label for="mealType">Maaltijdtype:</label>
            <select id="mealType" name="mealType">
                <option value="ontbijt">Ontbijt</option>
                <option value="avondmaal">Avondmaal</option>
                <option value="dessert">Dessert</option>
                <option value="middagmaal">Middagmaal</option>
                <option value="snack">Snack</option>
                <option value="voorgerecht">Voorgerecht</option>
            </select>

            <label for="prepTime">Bereidingstijd (Min):</label>
            <input type="number" id="prepTime" name="prepTime" min="0" required>

            <label for="difficulty">Moeijlijkheid (1-5):</label>
            <input type="number" id="difficulty" name="difficulty" min="1" max="5" required>

            <label for="servings">Aantal personen:</label>
            <input type="number" id="servings" name="servings" min="1" required>

            <button type="submit">Plaatsen</button>
        </form>
    </div>
    <?php
    require("../footer.php")
    ?>
</body>

</html>