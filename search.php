    <form action="index.php" method="post">
        <div class="row justify-content-center searchForm col-8">
            <div class="col-lg-5 col-md-12 my-1">
                <input type="text" class="form-control" name="cityName" placeholder="Város neve" required>
            </div>
            <div class="col-lg-4 col-md-12 my-1">
                <select class="form-select" aria-label="Temperature select" name="unit">
                    <option value="celsius">Celsius</option>
                    <option value="fahrenheit">Fahrenheit</option>
                    <option value="kelvin">Kelvin</option>
                </select>
            </div>
            <div class="col-lg-3 col-md-12 my-1"><button type="submit" class="btn btn-primary">Lekérdezés</button></div>
        </div>
    </form>