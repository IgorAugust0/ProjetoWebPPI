(function () {
  //script para enviar dados do formulário de login para o php
  async function sendForm(form) {
    try {
      let response = await fetch(form.action, {
        method: form.method,
        body: new FormData(form),
      });

      if (!response.ok) throw new Error(response.statusText);

      let result = await response.json();

      if (result.success) {
        window.location = result.detail;
      } else {
        document.querySelector("#loginFailMsg").style.display = "block";
        form.senha.value = "";
        form.senha.focus();
      }
    } catch (error) {
      console.error(error);
    }
  }

  window.onload = () => {
    const form = document.getElementById("formEntrar");
    form.addEventListener("submit", async (e) => {
      e.preventDefault();
      await sendForm(form);
    });
  };

  //script para ativar menu em mobile (em formato burguer)
  var MenuItems = document.getElementById("MenuItems");
  MenuItems.style.maxHeight = "0px";
  function menutoggle() {
    if (MenuItems.style.maxHeight == "0px") {
      MenuItems.style.maxHeight = "200px";
    } else {
      MenuItems.style.maxHeight = "0px";
    }
  }

  //script para ativar formulário
  const formEntrar = document.querySelector("#formEntrar");
  const formCadastrar = document.querySelector("#formCadastrar");
  const indicador = document.querySelector("#indicador");

  function cadastrar() {
    formCadastrar.style.transform = `translateX(0px)`;
    formEntrar.style.transform = `translateX(0px)`;
    indicador.style.transform = `translateX(100px)`;
  }

  function entrar() {
    formCadastrar.style.transform = `translateX(300px)`;
    formEntrar.style.transform = `translateX(300px)`;
    indicador.style.transform = `translateX(0px)`;
  }

  window.onload = function () {
    document.forms.formLogin.onsubmit = validaForm;
  };

  function validaForm(e) {
    //acesso ao objeto do formulário
    let form = e.target;
    let formValido = true;

    //acessa os objetos correspondentes aos spans
    const spanSenha = form.senha.nextElementSibling;
    const spanEmail = form.email.nextElementSibling;

    //inicia os spans com vazio
    spanSenha.textContent = "";
    spanEmail.textContent = "";

    //Se o campo estiver vazio o textContent é mudado colocando a mensagem de erro
    if (form.senha.value === "") {
      spanSenha.textContent = "A senha deve ser preenchida";
      formValido = false;
    }

    if (form.email.value === "") {
      spanEmail.textContent = "O email deve ser preenchido";
      formValido = false;
    }
    return formValido;
  }
});
