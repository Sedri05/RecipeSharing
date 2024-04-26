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
        <?php require("../../header.php")?>
        <div class="container">
            <div class="navigation">
                <h2>Nieuw recept maken:</h2>
                <form id="recipeForm">
                        <div class="row">
                            <div class="formnavigation">
                                <label class="label" for="title">Titel:</label>
                                <input class="text" id="title" name="title" required>
                                <label class="label" for="picture">Voeg een foto toe:</label>
                                <input class="file" type="file" id="picture" name="picture" accept="image/*" required>
                                <label class="label" for="tags">Tags:</label>
                                <div class="tag-container" id="tagContainer">
                                    <input class="text" type="text" id="tags" name="tags" class="tagInput">
                                </div>
                                <button class="button" type="button" onclick="addTag()">Tag toevoegen</button>

                                <label class="label" for="ingredients">Ingrediënten :</label>
                                <div class="tag-container" id="ingredientContainer">
                                    <input class="text" type="text" id="ingredients" name="ingredients" class="tagInput">
                                </div>
                                <button class="button" type="button" onclick="addIngredient()">Ingrediënt toevoegen</button>
                            </div>
                            <div class="tweededeel">
                                <label class="label" for="mealType">Maaltijdtype:</label>
                                <select class="select1" id="mealType" name="mealType">
                                    <option value="ontbijt">Ontbijt</option>
                                    <option value="avondmaal">Avondmaal</option>
                                    <option value="dessert">Dessert</option>
                                    <option value="middagmaal">Middagmaal</option>
                                    <option value="snack">Snack</option>
                                    <option value="voorgerecht">Voorgerecht</option>
                                </select>

                                <label class="label" for="prepTime">Bereidingstijd (Min):</label>
                                <input class="text2" type="number" id="prepTime" name="prepTime" min="0" required>

                                <label class="label" for="difficulty">Moeijlijkheid (1-5):</label>
                                <select class="select2" id="mealType" name="mealType">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>

                                <label class="label" for="servings">Aantal personen:</label>
                                <input class="text2" type="number" id="servings" name="servings" min="1" required>
                            </div>
                        </div>
                    <div class="bereiding">
                        <label class="label" for="instructions">Bereiding:</label>
                        <textarea class="textarea" id="instructions" name="instructions" rows="6" required></textarea>
                    
                        <button class="submitbutton" type="submit">Plaatsen</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    require("../../footer.php")
    ?>
</body>
</html>