var app = {
    init: function() {
      document.querySelector("#bill--form").addEventListener("submit", app.addBill);
      document.querySelector("#work-type").addEventListener("change", app.displayCompaniesList);
    },
    addBill: function(event) {
      event.preventDefault();
      const url = this.action;
      axios.post(url, {
        "workTypeTitle": this.querySelector('select[name="work-type"]').value,
        "companyTitle": this.querySelector('input[name="company"]').value,
        "statusTitle": this.querySelector('select[name="bill--status"]').value,
        "billEuro": this.querySelector('input[name="bill--price-euro"]').value,
        "billCent": this.querySelector('input[name="bill--price-cent"]').value,
        "billDescription": this.querySelector('textarea[name="bill--description"]').value,
      })
      .then(function (response) {
        const redirectUrl = document.querySelector('#home-page--link').href
        window.location.replace(redirectUrl);
      })
      .catch(function (error) {
        console.log(error);
      });
    },
    displayCompaniesList: function() {
      const companyInput = document.querySelector("#company");
      companyInput.disabled = false;
      document.querySelector("#bill--price-euro").disabled = false;
      document.querySelector("#bill--price-cent").disabled = false;
      document.querySelector("#bill--status").disabled = false;
      document.querySelector("#bill--description").disabled = false;
      const url = companyInput.dataset.url;
      axios.post(url, {
        "workTypeTitle": document.querySelector('select[name="work-type"]').value
      })
      .then(function (response) {
        const companyList = response.data;
        const companyDatalist = document.querySelector("#company--list");
        companyDatalist.innerHTML = "";
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
