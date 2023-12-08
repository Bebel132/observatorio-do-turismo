//função para a mudança de imagem de fundo ao decorrer do scroll da página
window.addEventListener("scroll", () => {
    //depois dos 2100px que for scrollado, a imagem de fundo vai ser alterada
    if (document.body.scrollTop > 2100 || document.documentElement.scrollTop > 2100) {
        document.body.style.backgroundImage = "url('resource/imgs/remo2.jpg')"
        document.body.style.boxShadow = "inset 0 0 30px var(--color-dark-blue)"
    } else {
        document.body.style.backgroundImage = "url('resource/imgs/pontevelha.jpg')"
        document.body.style.boxShadow = "none"
    }
})

//função para o efeito de "diminuir e aumentar" do menu
window.addEventListener("scroll", () => {
    //depois dos 650px que for scrollado o efeito será ativado
    if (document.body.scrollTop > 650 || document.documentElement.scrollTop > 650) {
        //selecionar a tag do menu e adicionar os estilos do efeito
        document.querySelector(".header-topbar-container").classList.add("topBar-switch")
        document.querySelectorAll(".menu-item").forEach(e => {
            e.style.height = "3rem"
        })
        document.querySelector(".logo").style.height = "3rem"
    } else {
        //selecionar a tag do menu e remover os estilos do efeito
        document.querySelector(".header-topbar-container").classList.remove("topBar-switch")
        document.querySelectorAll(".menu-item").forEach(e => {
            e.style.height = "5rem"
        })
        document.querySelector(".logo").style.height = "5rem"
    }
})

//adicionando função de abrir e fechar para o menu lateral
document.querySelector(".fa-bars").addEventListener("click", () => {
    document.querySelector(".header-sideBar").classList.toggle("closed")
})

//função para fechar o menu lateral quando o usuário apertar em algum item
document.querySelectorAll(".sidebar_menu-item").forEach(e => {
    e.addEventListener("click", () => {
        document.querySelector(".header-sideBar").classList.add("closed")
    })
})

//função de abrir e fechar dos textos do dti
document.querySelectorAll(".dti_box-title").forEach(e => {
    e.addEventListener("click", () => {
        e.parentNode.children[1].classList.toggle("opened")
        e.parentNode.children[1].children[0].classList.toggle("closed-text")
    })
})

//cores do dti
const dti_box = document.querySelectorAll(".dti-box");
const dti_cores = [
    '#4285F4',
    '#ea4234',
    '#fbbc04',
    '#35a852',
    '#fe6c01',
    '#46bdc6',
    '#7babf6',
    '#f07b72',
    '#fdd04e'
]

//adicionando as cores aos titulos do dti
for(i = 0; i < dti_cores.length; i++) {
    dti_box[i].children[0].style.backgroundColor = dti_cores[i];
}

//organizando os boxes das pesquisas dentro de um array
let pesquisasBoxesTags = document.querySelectorAll(".pesquisas-box")
let pesquisasBoxes = []
pesquisasBoxesTags.forEach(tag => {
    let pesquisasBox = {
        'id': tag.classList[1],
        'box': tag
    }
    pesquisasBoxes.push(pesquisasBox)
})

//funcao para resumir o texto das pesquisas
document.querySelectorAll(".pesquisas_box-content").forEach(e => {
    let textoCompleto = e.children[0].textContent;

    // Verifica se o texto completo é maior que 150 caracteres
    if (textoCompleto.length > 150) {
        // Encontra o último espaço em branco dentro dos primeiros 150 caracteres
        let ultimoEspaco = textoCompleto.lastIndexOf(' ', 150);

        // Cria o texto resumido usando o último espaço em branco
        let textoResumido = textoCompleto.slice(0, ultimoEspaco) + '...Ler mais:';

        // Atualiza o conteúdo do elemento
        e.children[0].innerHTML = "";
        e.children[0].append(textoResumido);
    }
});

//criando um objeto para "filrar as pesquisas ade acordo com o ano"
const objetoAgrupado = {};

pesquisasBoxes.forEach(obj => {
    const id = obj.id;

    if (!objetoAgrupado[id]) {
        objetoAgrupado[id] = [];
    }

    objetoAgrupado[id].push(obj);
});
const pesquisas = Object.values(objetoAgrupado);
//exemplo:
// pesquisas = [
//     [
//         {id": "15","box": {}},{"id": "15","box": {}},{"id": "15","box": {}}
//     ],
//     [
//         {"id": "16","box": {}},{"id": "16","box": {}}
//     ],
//     [
//         {"id": "19","box": {}}
//     ]
// ]
//dentro do array "pesquisas" há outros array onde o conteúdo desses está filtrado de acordo com o seu id(número de id do ano que está no banco)

document.querySelector(".pesquisas-boxes").innerHTML = ""

//função para mostrar as pesquisas de acordo com o seu ano
let limite = 2;
let limiteMaximo = 0;
let secaoAtual = '';

document.querySelectorAll(".pesquisas_barraLateral_lista-opcao").forEach(e => {
    e.addEventListener("click", () => {
        document.querySelector(".controller").classList.remove("closed");

        // Calcular o limite máximo com base no número real de caixas
        let arr = getPesquisasPorSecao(e.classList[1]);
        limiteMaximo = arr.length;
        secaoAtual = e.classList[1];

        limite = 2;
        mostrarPesquisas(secaoAtual, limite);
    });
});

document.querySelector(".pos").addEventListener("click", () => {
    limite = Math.min(limite + 2, limiteMaximo);
    mostrarPesquisas(secaoAtual, limite);
});

document.querySelector(".prev").addEventListener("click", () => {
    limite = Math.max(limite - 2, 2);
    mostrarPesquisas(secaoAtual, limite);
});

function getPesquisasPorSecao(secao) {
    // Substitua pesquisas pelo seu array de dados real
    return pesquisas.flat().filter(box => box.id === secao);
}

function mostrarPesquisas(secao, limite) {
    document.querySelector(".pesquisas-boxes").innerHTML = "";
    let arr = getPesquisasPorSecao(secao);

    // Calcular o início do loop com base no limite e no tamanho do array
    let inicio = Math.max(0, limite - 2);
    if (arr.length % 2 !== 0 && limite === arr.length) {
        inicio = limite - arr.length % 2;
    }

    for (let i = inicio; i < Math.min(limite, arr.length); i++) {
        if (arr[i]) {
            document.querySelector(".pesquisas-boxes").append(arr[i].box);
        }
    }

    document.querySelector(".count").innerHTML = "";
    document.querySelector(".count").append(document.createTextNode(limite + "/" + arr.length));
}


