<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent House Registration</title>
    <!-- Using the style we created as reference -->
    <link rel="stylesheet" href="css/rent_info_style.css">
</head>
<body>
    <div class="student form">
        <div class="container">
            <!-- Independent Header -->
            <div class="page-header">
                <nav class="page-nav">
                    <a class="nav-link" href="index.php">Home</a>
                </nav>
            </div>

            <h1>Missing Item Information</h1>
            
            <form action="item_info_class.php" method="post" id="item-form">
                <!-- Item Type Field -->
                <div class="field-group">
                    <label>Item Type</label>
                    <div class="field-row">
                        <input type="text" name="itemtype" id="itemtype" placeholder="Item Type" required>
                    </div>
                </div>
                <div class="field-group">
                    <label for="item_name">Item Name</label>
                    <div class="field-row">
                        <input type="text" name="itemname" id="item_name" placeholder="Item Name" required>
                    </div>
                </div>

                <!-- Item Image Field -->
                <div class="field-group">
                    <label for="item_img">Item Image</label>
                    <div class="field-row">
                        <input type="text" name="itemimg" id="item_img" placeholder="Item Image URL" required>
                    </div>
                </div>

                <!-- Date Field -->
                <div class="field-group">
                    <label for="date">Date</label>
                    <div class="field-row">
                        <input type="date" name="date" id="date" required>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="button-row">
                    <button type="submit" name="submit_rent" id="submit">Submit Info</button>
                    <button type="button" id="clear" onclick="this.form.reset()">Clear Fields</button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Optional: Linking your existing JS if needed for other functions -->
    <script src="script/index.js"></script>
</body>
</html>