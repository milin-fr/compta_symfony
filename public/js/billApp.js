var app = {
    init: function() {
      document.querySelector("#bill--form").addEventListener("submit", app.addBill);
      document.querySelector("#work-type").addEventListener("change", app.displayCompaniesList);
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
    displayCompaniesList: function() {
      const companyInput = document.querySelector("#company");
      companyInput.disabled = false;
      const url = companyInput.dataset.url;
      axios.get(url, {})
      .then(function (response) {
        const companyList = response.data;
        const companyDatalist = document.querySelector("#company--list");
        companyList.forEach(element => {
          const option = document.createElement('option');
          option.value = element.title;
          companyDatalist.appendChild(option);
        });
      })
      .catch(function (error) {
        console.log(error);
      });
    }
};
  
document.addEventListener('DOMContentLoaded', app.init);
