var app = {
    init: function() {
      document.querySelector("#bill--form").addEventListener("submit", app.addBill);
    },
    addBill: function(event) {
      event.preventDefault();
      const url = this.action;
      axios.post(url, {
        "workTypeTitle": this.querySelector('input[name="work-type"]').value,
        "companyTitle": this.querySelector('input[name="company"]').value,
        "billEuro": this.querySelector('input[name="bill--price-euro"]').value,
        "billCent": this.querySelector('input[name="bill--price-cent"]').value,
        "billDescription": this.querySelector('textarea[name="bill--description"]').value,
      })
      .then(function (response) {
        console.log(response);
      })
      .catch(function (error) {
        console.log(error);
      });
    },
};
  
document.addEventListener('DOMContentLoaded', app.init);
