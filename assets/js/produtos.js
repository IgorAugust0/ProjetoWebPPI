// funcao para buscar todas as categorias no banco de dados e colocar no label para select usando fetch
async function buscarCategorias() {
  try {
    const response = await fetch("../php/categorias.php");
    const data = await response.json();
    let html = '<option value="">Selecione uma categoria</option>';
    data.forEach((categoria) => {
      html += `<option value="${categoria.code}">${categoria.name}</option>`;
    });
    document.getElementById("categoria").innerHTML = html;
  } catch (e) {
    console.error(e);
  }
}

// funcao para buscar todos os produtos de acordo com a categoria selecionada
async function renderProducts(newProducts) {
  const prodsSection = document.getElementById("products");
  const template = document.getElementById("template");

  // Remove os produtos antigos
  while (prodsSection.children.length > 1) {
    prodsSection.removeChild(prodsSection.lastChild);
  }

  // Adiciona os novos produtos
  await Promise.all(
    newProducts.map(async (product) => {
      let productElement = template.content.cloneNode(true);
      productElement.querySelector(".item-image").src =
        "../assets/images/" + product.imagePath;
      productElement.querySelector(".item-name").textContent = product.name;
      productElement.querySelector(".item-price").textContent = product.price;

      prodsSection.appendChild(productElement);
    })
  );
}

async function loadProducts() {
  try {
    const selectCategoria = document.getElementById("categoria");
    const codCategoria = selectCategoria.value;

    const response = await fetch(
      `../php/produtos.php?codCategoria=${codCategoria}`
    );
    if (!response.ok) throw new Error(response.statusText);
    const products = await response.json();

    renderProducts(products);
  } catch (e) {
    console.error(e);
  }
}

// async function loadProducts() {
//   try {
//     var selectCategoria = document.getElementById("categoria");
//     // Obtém o valor selecionado do select da categoria
//     var codCategoria = selectCategoria.value;
//     // Verifica se um valor de categoria foi selecionado

//     let response = await fetch(
//       "../php/produtos.php?codCategoria=" + codCategoria
//     );
//     if (!response.ok) throw new Error(response.statusText);
//     var products = await response.json();
//   } catch (e) {
//     console.error(e);
//     return;
//   }

//   renderProducts(products);
// }

async function buscarAnuncioPorNome() {
  try {
    const nomeProd = document.getElementById("inputNomeAnuncio").value;
    const response = await fetch(`../php/produtos.php?nome=${nomeProd}`);
    if (!response.ok) throw new Error(response.statusText);
    const products = await response.json();
    renderProducts(products);
  } catch (e) {
    console.error(e);
  }
}

const btnBuscarAnuncio = document.querySelector("#btnBuscarAnuncio");
btnBuscarAnuncio.addEventListener("click", buscarAnuncioPorNome);

const selectCategoria = document.querySelector("#categoria");
selectCategoria.addEventListener("change", loadProducts);

window.onload = async function () {
  await buscarCategorias();
  await loadProducts();
};

window.onscroll = async function () {
  if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
    await loadProductsInfinity();
  }
};

let offset = 0; // Variável para controlar a quantidade de anúncios já carregados

async function loadProductsInfinity() {
  try {
    const codCategoria = document.querySelector("#categoria").value;
    const page =
      Math.ceil((document.querySelector("#products").children.length - 1) / 6) +
      1;
    const response = await fetch(
      `../php/produtos.php?codCategoria=${codCategoria}&page=${page}`
    );
    if (!response.ok) throw new Error(response.statusText);
    const products = await response.json();
    renderProductsInfinity(products);
  } catch (e) {
    console.error(e);
  }
}

async function renderProductsInfinity(newProducts) {
  const prodsSection = document.querySelector("#products");
  const template = document.querySelector("#template");

  // Adiciona os novos produtos
  await Promise.all(
    newProducts.map(async (product) => {
      let productElement = template.content.cloneNode(true);
      productElement.querySelector(
        ".item-image"
      ).src = `../assets/images/${product.imagePath}`;
      productElement.querySelector(".item-name").textContent = product.name;
      productElement.querySelector(".item-price").textContent = product.price;

      prodsSection.appendChild(productElement);
    })
  );
}

// var MenuItems = document.getElementById("MenuItems");
// MenuItems.style.maxHeight = "0px";
// function menutoggle() {
//   if (MenuItems.style.maxHeight == "0px") {
//     MenuItems.style.maxHeight = "200px";
//   } else {
//     MenuItems.style.maxHeight = "0px";
//   }
// }

// // funcao para buscar todas as categorias no banco de dados e colocar no label para select usando fetch

// function buscarCategorias() {
//   fetch("../php/categorias.php")
//     .then((response) => response.json())
//     .then((data) => {
//       let html = '<option value="">Selecione uma categoria</option>';
//       data.forEach((categoria) => {
//         html += `<option value="${categoria.code}">${categoria.name}</option>`;
//       });
//       document.getElementById("categoria").innerHTML = html;
//     });
// }

// // funcao para buscar todos os produtos de acordo com a categoria selecionada

// function renderProducts(newProducts) {
//   const prodsSection = document.getElementById("products");
//   const template = document.getElementById("template");

//   // Remove os produtos antigos
//   while (prodsSection.children.length > 1) {
//     prodsSection.removeChild(prodsSection.lastChild);
//   }

//   // Adiciona os novos produtos
//   for (let product of newProducts) {
//     let productElement = template.content.cloneNode(true);
//     productElement.querySelector(".item-image").src =
//       "../assets/images/" + product.imagePath;
//     productElement.querySelector(".item-name").textContent = product.name;
//     productElement.querySelector(".item-price").textContent = product.price;

//     prodsSection.appendChild(productElement);
//   }
// }

// async function loadProducts() {
//   try {
//     var selectCategoria = document.getElementById("categoria");
//     // Obtém o valor selecionado do select da categoria
//     var codCategoria = selectCategoria.value;
//     // Verifica se um valor de categoria foi selecionado

//     let response = await fetch(
//       "../php/produtos.php?codCategoria=" + codCategoria
//     );
//     if (!response.ok) throw new Error(response.statusText);
//     var products = await response.json();
//   } catch (e) {
//     console.error(e);
//     return;
//   }

//   renderProducts(products);
// }

// // funcao para buscar o produto pelo nome
// async function buscarAnuncioPorNome() {
//   try {
//     var selecNomeProd = document.getElementById("inputNomeAnuncio");
//     // Obtém o valor selecionado do select da categoria
//     var nomeProd = selecNomeProd.value;
//     // Verifica se um valor de categoria foi selecionado

//     let response = await fetch("../php/produtos.php?nome=" + nomeProd);
//     if (!response.ok) throw new Error(response.statusText);
//     var products = await response.json();
//   } catch (e) {
//     console.error(e);
//     return;
//   }

//   renderProducts(products);
// }

// // Adicione um evento de clique ao botão de busca
// const btnBuscarAnuncio = document.getElementById("btnBuscarAnuncio");
// btnBuscarAnuncio.addEventListener("click", buscarAnuncioPorNome);

// // funcao para que a cada vez que mudar a categoria selecionada, os produtos atuais sejam exluídos e os novos sejam carregados

// var selectCategoria = document.getElementById("categoria");
// selectCategoria.addEventListener("change", loadProducts);

// window.onload = function () {
//   buscarCategorias();
//   loadProducts();
// };

// window.onscroll = function () {
//   if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
//     loadProductsInfinity();
//   }
// };

// let offset = 0; // Variável para controlar a quantidade de anúncios já carregados

// async function loadProductsInfinity() {
//   try {
//     var selectCategoria = document.getElementById("categoria");
//     var codCategoria = selectCategoria.value;

//     // Adicione a variável "page" para indicar a página atual
//     var page =
//       Math.ceil((document.getElementById("products").children.length - 1) / 6) +
//       1;

//     let response = await fetch(
//       `../php/produtos.php?codCategoria=${codCategoria}&page=${page}`
//     );
//     if (!response.ok) throw new Error(response.statusText);
//     var products = await response.json();

//     renderProductsInfinity(products);
//   } catch (e) {
//     console.error(e);
//     return;
//   }
// }

// function renderProductsInfinity(newProducts) {
//   const prodsSection = document.getElementById("products");
//   const template = document.getElementById("template");

//   // Adiciona os novos produtos
//   for (let product of newProducts) {
//     let productElement = template.content.cloneNode(true);
//     productElement.querySelector(".item-image").src =
//       "../assets/images/" + product.imagePath;
//     productElement.querySelector(".item-name").textContent = product.name;
//     productElement.querySelector(".item-price").textContent = product.price;

//     prodsSection.appendChild(productElement);
//   }
// }
