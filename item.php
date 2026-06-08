<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Report Information</title>
    <link rel="stylesheet" href="css/rent_info_style.css">
</head>
<body>
    <div class="student form">
        <div class="container">
            <div class="page-header">
                <nav class="page-nav">
                    <a class="nav-link" href="index.php">Home</a>
                </nav>
            </div>

            <h1>Item Report Information</h1>
            
            <form action="item_class.php" method="post" id="item-form">
                <div class="field-group">
                    <label for="item_type_label">Item Type</label>
                    <div class="field-row">
                        <input type="text" name="item_type" id="item_type" required>
                    </div>
                </div>

                <div class="field-group">
                    <label for="item_brand_label">Item Brand</label>
                    <div class="field-row">
                        <input type="text" name="item_brand" id="item_brand" required>
                    </div>
                </div>

                <div class="field-group">
                    <label for="item_color_label">Item Color</label>
                    <div class="field-row">
                        <input type="text" name="item_color" id="item_color" required>
                    </div>
                </div>

                <div class="field-group">
                    <label for="item_color_label">Report Type</label>
                    <div class="field-row">
                        <input type="radio" name="report_type" id="missing" value = "Missing" required>Missing
                        <input type="radio" name="report_type" id="found" value = "Found" required>Found
                    </div>
                </div>

                <div class="field-group">
                    <label for="item_color_label">Date</label>
                    <div class="field-row">
                        <input type="date" name="item_date" id="item_date" required>
                    </div>
                </div>

                <div class="field-group">
                    <label for="item_picture_label">Item Picture</label>
                    <div class="field-row">
                        <button> Upload an Image</button>
                    </div>
                </div>


                <div class="button-row">
                    <button type="submit" name="submit_rent" id="submit">Submit Info</button>
                    <button type="button" id="clear">Clear Fields</button>
                </div>

                

                
            </form>
        </div>
    </div>
    <script src="script/index.js"></script>
</body>
</html>