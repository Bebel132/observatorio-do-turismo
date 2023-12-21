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

window.addEventListener("scroll", () => {
    if (document.body.scrollTop > 1000 || document.documentElement.scrollTop > 1000) {
        document.body.style.backgroundImage = "none"
        document.body.style.boxShadow = "none"
    } else {
        document.body.style.backgroundImage = "url('resource/imgs/beiraMar2.jpg')"
        document.body.style.boxShadow = "inset 0 0 30px var(--color-base-dark)"
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

const botaoLerMais = document.querySelectorAll('.ler-mais');
const boxes = document.querySelectorAll('.quemSomos_boxes-content p');
let truncado = true;

botaoLerMais.forEach((botao, index) => {
    const texto = boxes[index];

    botao.addEventListener('click', function() {
        if (truncado) {
            texto.parentNode.parentNode.style.height = "560px"
            texto.style.maxHeight = 'none';
            texto.style.overflow = 'auto';
            botao.textContent = 'Ler menos';
        } else {
            texto.parentNode.parentNode.style.height = "350px"
            texto.style.maxHeight = '100px';
            texto.style.overflow = 'hidden';
            botao.textContent = 'Ler mais';
        }
        truncado = !truncado;
    });
});


//função de abrir e fechar dos textos do dti
document.querySelectorAll(".dti_box-title").forEach(e => {
    e.addEventListener("click", () => {
        e.parentNode.children[1].classList.toggle("opened")
        e.parentNode.children[1].children[0].classList.toggle("closed-text")
    })
})

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
    let textoCompleto = e.children[0].textContent

    // Verifica se o texto completo é maior que 150 caracteres
    if (textoCompleto.length > 150) {
        // Encontra o último espaço em branco dentro dos primeiros 150 caracteres
        let ultimoEspaco = textoCompleto.lastIndexOf(' ', 150)

        // Cria o texto resumido usando o último espaço em branco
        let textoResumido = textoCompleto.slice(0, ultimoEspaco) + '...Ler mais:'

        // Atualiza o conteúdo do elemento
        e.children[0].innerHTML = ""
        e.children[0].append(textoResumido)
    }
})

//criando um objeto para "filrar as pesquisas ade acordo com o ano"
const objetoAgrupado = {}

pesquisasBoxes.forEach(obj => {
    const id = obj.id

    if (!objetoAgrupado[id]) {
        objetoAgrupado[id] = []
    }

    objetoAgrupado[id].push(obj)
})
const pesquisas = Object.values(objetoAgrupado)
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

function transformarData(data) {
    var [ano, mes, dia, hora, minuto, segundo] = data.split(' ')[0].split('-');

    return `${dia}/${mes}/${ano}`;
}

document.querySelectorAll(".pesquisas-box").forEach(e => {
    let novoTexto = transformarData(e.children[0].children[2].textContent)
    e.children[0].children[2].innerHTML = ""
    e.children[0].children[2].append(document.createTextNode(novoTexto))
})

document.querySelector(".pesquisas-boxes").innerHTML = ""

//função para mostrar as pesquisas de acordo com o seu ano
let limite = 4
let limiteMaximo = 0
let secaoAtual = ''

document.querySelectorAll(".pesquisas_barraLateral_lista-opcao").forEach(e => {
    e.addEventListener("click", () => {
        // Tirar o efeito de "selecionado"
        document.querySelectorAll(".pesquisas_barraLateral_lista-opcao").forEach(i => {
            i.classList.remove("selecionado")
        })
        // Adicionar efeito de "selecionado"
        e.classList.toggle("selecionado")

        document.querySelector(".controller").classList.remove("closed")

        // Calcular o limite máximo com base no número real de caixas
        let arr = getPesquisasPorSecao(e.classList[1])
        limiteMaximo = arr.length

        if(limiteMaximo <= 4){
            limite = limiteMaximo
        } else {
            limite = 4
        }

        secaoAtual = e.classList[1]
        
        mostrarPesquisas(secaoAtual, limite)
    })
})

document.querySelector(".pos").addEventListener("click", () => {
    limite = Math.min(limite + 4, limiteMaximo)
    mostrarPesquisas(secaoAtual, limite)
})

document.querySelector(".prev").addEventListener("click", () => {
    limite = Math.max(limite - 4, 4)
    mostrarPesquisas(secaoAtual, limite)
})

function getPesquisasPorSecao(secao) {
    // Substitua pesquisas pelo seu array de dados real
    return pesquisas.flat().filter(box => box.id === secao)
}

function mostrarPesquisas(secao, limite) {
    document.querySelector(".pesquisas-boxes").innerHTML = ""
    let arr = getPesquisasPorSecao(secao)

    // Calcular o início do loop com base no limite e no tamanho do array
    let inicio = Math.max(0, limite - 4)
    if (arr.length % 4 !== 0 && limite === arr.length) {
        inicio = limite - arr.length % 4
    }

    for (let i = inicio; i < Math.min(limite, arr.length); i++) {
        if (arr[i]) {
            document.querySelector(".pesquisas-boxes").append(arr[i].box)
        }
    }

    document.querySelector(".count").innerHTML = ""
    document.querySelector(".count").append(document.createTextNode(limite + "/" + arr.length))
}

document.querySelectorAll(".pesquisas_barraLateral_lista-opcao")[0].click()
