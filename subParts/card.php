
 <div class="page">
  <div class="page__demo">
    <form class="payment-card">
      <div class="payment-card__front">
        <div class="payment-card__group">
          <label class="payment-card__field">
            <span class="payment-card__hint">Holder of card</span>
            <input class="payment-card__input" placeholder="Holder of card" pattern="[A-Za-z, ]{2,}" name="holder-card" required>
          </label>
        </div>
        <div class="payment-card__group">
          <label class="payment-card__field">
            <span class="payment-card__hint">Number of card</span>
            <input type="text" class="payment-card__input" placeholder="Number of card" pattern="[0-9]{16}" name="number-card" required>
          </label>
        </div>
        <div class="payment-card__group">
          <span class="payment-card__caption">valid thru</span>
        </div>
        <div class="payment-card__group payment-card__footer">
          <label class="payment-card__field payment-card__month">
            <span class="payment-card__hint">Month</span>
            <input type="text" class="payment-card__input" placeholder="MM" maxlength="2" pattern="[0-9]{2}" name="mm-card" required>
          </label>
          <span class="payment-card__separator">/</span>
          <label class="payment-card__field payment-card__year">
            <span class="payment-card__hint">Year</span>
            <input type="text" class="payment-card__input" placeholder="YY" maxlength="2" pattern="[0-9]{2}" name="year-card" required>
          </label>
        </div>
      </div>
      <div class="payment-card__back">
        <div class="payment-card__group">
          <label class="payment-card__field payment-card__cvc">
            <span class="payment-card__hint">CVC</span>
            <input type="text" class="payment-card__input" placeholder="CVC" maxlength="3" pattern="[0-9]{3}" name="cvc-card" required>
          </label>
        </div>
      </div>
      </div>
    <button class="payment-card__button" hidden>Send</button>
    </form>
</div>
