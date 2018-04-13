<form class="form-horizontal" method="POST" action="map/index.php">

    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!--CREDIT CART PAYMENT-->

    <div class="panel panel-info">
        <div class="panel-heading"><span><i class="glyphicon glyphicon-lock"></i></span> Secure Payment</div>
        <div class="panel-body">
            <div class="control-group">
                <label class="control-label">Card Holder's Name</label>
                <div class="controls">
                  <div class="row-fluid">
                    <div class="span4">
                      <input type="text" class="input-block-level" pattern="\w+ \w+.*" title="Fill your first and last name" required>
                  </div>
              </div>
          </div>
      </div>

      <div class="control-group">
        <label class="control-label">Card Number</label>
        <div class="controls">
          <div class="row-fluid">
            <div class="span1">
              <input type="text" class="input-block-level" autocomplete="off" maxlength="4" pattern="\d{4}" title="First four digits" required>
          </div>
          <div class="span1">
              <input type="text" class="input-block-level" autocomplete="off" maxlength="4" pattern="\d{4}" title="Second four digits" required>
          </div>
          <div class="span1">
              <input type="text" class="input-block-level" autocomplete="off" maxlength="4" pattern="\d{4}" title="Third four digits" required>
          </div>
          <div class="span1">
              <input type="text" class="input-block-level" autocomplete="off" maxlength="4" pattern="\d{4}" title="Fourth four digits" required>
          </div>
      </div>
  </div>

</div>

<div class="control-group">
    <label class="control-label">Card Expiry Date</label>
    <div class="controls">
      <div class="row-fluid">
        <div class="span2">
          <select class="input-block-level">
            <option value="">Month</option>
            <option value="01">01</option>
            <option value="02">02</option>
            <option value="03">03</option>
            <option value="04">04</option>
            <option value="05">05</option>
            <option value="06">06</option>
            <option value="07">07</option>
            <option value="08">08</option>
            <option value="09">09</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
        </select>
    </div>
    <div class="span2">
      <select class="input-block-level">
        <option value="">Year</option>
        <option value="2018">2018</option>
        <option value="2019">2019</option>
        <option value="2020">2020</option>
        <option value="2021">2021</option>
        <option value="2022">2022</option>
        <option value="2023">2023</option>
        <option value="2024">2024</option>
        <option value="2025">2025</option>
        <option value="2025">2026</option>
        <option value="2025">2027</option>
        <option value="2025">2028</option>
    </select>
</div>
</div>
</div>
</div>

<div class="control-group">
    <label class="control-label">Card CVV</label>
    <div class="controls">
      <div class="row-fluid">
        <div class="span1">
          <input type="text" class="input-block-level" autocomplete="off" minlength="3" maxlength="4" pattern="\d{3-4}" title="Three digits at back of your card" required>
      </div>

  </div>
</div>
</div>
<div class="form-group" >
    <div class="top-margin col-md-6 col-sm-6 col-xs-12">
        <button name="orderSubmitted" type="submit" class="btn btn-primary btn-block" >Place Order</button>
    </div>
</div>
</div>
</div>
</form>
