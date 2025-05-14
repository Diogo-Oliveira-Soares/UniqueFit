<?php
session_start();  // Démarrage de la session pour gérer le panier
global $conn;
require_once '../Model/db_connector.php';

$id = $_GET['id'] ?? 1;

// Récupération du produit
$stmt = $conn->prepare("SELECT * FROM Products WHERE idproducts = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();

// Chemin de l’image du produit (mise à jour pour correspondre aux autres pages)
$imagePath = !empty($product['image']) ? '../CSS-Image/Image/' . $product['image'] : '../CSS-Image/Image/default-tshirt.png';

// Ajout du produit au panier si nécessaire
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données envoyées depuis la requête AJAX (les personnalisations)
    $customProduct = [
        'id' => $product['idproducts'],
        'name' => $product['name'],
        'text' => $_POST['text'] ?? '',
        'textColor' => $_POST['textColor'] ?? '#000000',
        'textSize' => $_POST['textSize'] ?? 24,
        'backgroundColor' => $_POST['backgroundColor'] ?? 'transparent',
        'imageSrc' => $_POST['imageSrc'] ?? $imagePath,
        'imageShape' => $_POST['imageShape'] ?? '0%',  // par défaut carré
        'imageSize' => $_POST['imageSize'] ?? 100,
    ];

    // Vérifier si le panier existe, sinon le créer
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Ajouter le produit personnalisé au panier
    $_SESSION['cart'][] = $customProduct;

    // Retourner une réponse JSON
    echo json_encode(['success' => true]);
    exit;  // Terminer le script ici après avoir ajouté au panier
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personnalisation - <?= htmlspecialchars($product['name']) ?></title>
    <script src="https://cdn.jsdelivr.net/npm/interactjs@1.10.11/dist/interact.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        #preview {
            position: relative;
            width: 100%;
            height: 400px;
            background-image: url('<?= $imagePath ?>');
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            transition: background-color 0.3s ease;
            border: 1px solid #ddd;
        }

        #previewText {
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 24px;
            color: #000; /* Par défaut, couleur du texte noir */
            font-weight: bold;
            cursor: move;
        }

        #previewImage {
            position: absolute;
            max-width: 100px;
            max-height: 100px;
            bottom: 20px;
            right: 20px;
            cursor: move;
            border-radius: 0%; /* Par défaut carré */
        }

        .range-input {
            width: 100%;
        }
    </style>
</head>
<body>

<?php include __DIR__ . "/navbar.php"; ?>

<div class="container my-5">
    <h2 class="mb-4">Personnalisation - <?= htmlspecialchars($product['name']) ?></h2>
    <div class="row">
        <!-- Formulaire de personnalisation -->
        <div class="col-md-6">
            <form id="customForm">
                <div class="mb-3">
                    <label for="colorSelect" class="form-label">Couleur de fond</label>
                    <select id="colorSelect" class="form-select">
                        <option value="transparent">Aucune</option>
                        <option value="white">Blanc</option>
                        <option value="black">Noir</option>
                        <option value="red">Rouge</option>
                        <option value="blue">Bleu</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="textInput" class="form-label">Texte</label>
                    <input type="text" id="textInput" class="form-control" placeholder="Votre texte">
                </div>

                <div class="mb-3">
                    <label for="textColorSelect" class="form-label">Couleur du texte</label>
                    <input type="color" id="textColorSelect" class="form-control" value="#000000">
                </div>

                <div class="mb-3">
                    <label for="textSizeInput" class="form-label">Taille du texte</label>
                    <input type="range" id="textSizeInput" class="form-control range-input" min="10" max="100" value="24">
                </div>

                <div class="mb-3">
                    <label for="imageInput" class="form-label">Image</label>
                    <input type="file" id="imageInput" class="form-control" accept="image/*">
                </div>

                <div class="mb-3">
                    <label for="imageSizeInput" class="form-label">Taille de l'image</label>
                    <input type="range" id="imageSizeInput" class="form-control range-input" min="50" max="200" value="100">
                </div>

                <div class="mb-3">
                    <label for="imageShape" class="form-label">Forme de l'image</label>
                    <select id="imageShape" class="form-select">
                        <option value="0%">Carré</option>
                        <option value="50%">Rond</option>
                    </select>
                </div>

                <button type="button" class="btn btn-primary mt-3" id="addToCart">Ajouter au panier</button>
            </form>
        </div>

        <!-- Aperçu de la personnalisation -->
        <div class="col-md-6">
            <h5>Aperçu</h5>
            <div id="preview" class="border rounded">
                <div id="previewText"></div>
                <img id="previewImage" src="<?= $imagePath ?>" alt="Image personnalisée" class="d-none">
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . "/footer.html"; ?>

<script>
    const colorSelect = document.getElementById("colorSelect");
    const textInput = document.getElementById("textInput");
    const textColorSelect = document.getElementById("textColorSelect");
    const textSizeInput = document.getElementById("textSizeInput");
    const imageInput = document.getElementById("imageInput");
    const imageSizeInput = document.getElementById("imageSizeInput");
    const imageShapeSelect = document.getElementById("imageShape");
    const preview = document.getElementById("preview");
    const previewText = document.getElementById("previewText");
    const previewImage = document.getElementById("previewImage");

    // Modifier la couleur de fond de l'habit
    colorSelect.addEventListener("change", () => {
        preview.style.backgroundColor = colorSelect.value;
    });

    // Ajouter ou modifier le texte
    textInput.addEventListener("input", () => {
        previewText.textContent = textInput.value;
    });

    // Modifier la couleur du texte
    textColorSelect.addEventListener("input", () => {
        previewText.style.color = textColorSelect.value;
    });

    // Ajuster la taille du texte
    textSizeInput.addEventListener("input", () => {
        previewText.style.fontSize = `${textSizeInput.value}px`;
    });

    // Ajouter l'image personnalisée
    imageInput.addEventListener("change", (event) => {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                previewImage.src = e.target.result;
                previewImage.classList.remove("d-none"); // Afficher l'image
            };
            reader.readAsDataURL(file);
        }
    });

    // Ajuster la taille de l'image
    imageSizeInput.addEventListener("input", () => {
        const size = imageSizeInput.value;
        previewImage.style.width = `${size}px`;
        previewImage.style.height = `${size}px`;
    });

    // Ajuster la forme de l'image
    imageShapeSelect.addEventListener("change", () => {
        const shape = imageShapeSelect.value;
        previewImage.style.borderRadius = shape;
    });

    // Interact.js pour rendre le texte déplaçable
    interact('#previewText')
        .draggable({
            onmove(event) {
                const { target } = event;
                const x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx;
                const y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;

                target.style.transform = `translate(${x}px, ${y}px)`;
                target.setAttribute('data-x', x);
                target.setAttribute('data-y', y);
            }
        });

    // Interact.js pour rendre l'image déplaçable
    interact('#previewImage')
        .draggable({
            onmove(event) {
                const { target } = event;
                const x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx;
                const y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;

                target.style.transform = `translate(${x}px, ${y}px)`;
                target.setAttribute('data-x', x);
                target.setAttribute('data-y', y);
            }
        });

    // Lorsque l'utilisateur clique sur "Ajouter au panier"
    document.getElementById("addToCart").addEventListener("click", () => {
        const text = textInput.value;
        const textColor = textColorSelect.value;
        const textSize = textSizeInput.value;
        const backgroundColor = colorSelect.value;
        const imageSrc = previewImage.src !== '' ? previewImage.src : '<?= $imagePath ?>'; // Si une image a été ajoutée
        const imageShape = imageShapeSelect.value;
        const imageSize = imageSizeInput.value;

        // Envoi des données via fetch
        fetch(window.location.href, {
            method: 'POST',
            body: new URLSearchParams({
                'text': text,
                'textColor': textColor,
                'textSize': textSize,
                'backgroundColor': backgroundColor,
                'imageSrc': imageSrc,
                'imageShape': imageShape,
                'imageSize': imageSize
            })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Produit ajouté au panier');
                } else {
                    alert('Une erreur est survenue');
                }
            })
            .catch(error => console.error('Erreur:', error));
    });
</script>

</body>
</html>
