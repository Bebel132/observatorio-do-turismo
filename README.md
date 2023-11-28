
# Observatorio do Turismo

"documentação" para entendimento da estrutura do código do site



## 1. Estrutura das pastas
[![https://imgur.com/b1fXZSs.png](https://imgur.com/b1fXZSs.png)](https://imgur.com/b1fXZSs.png)
| pasta               | descrição                                                |
| ----------------- | ---------------------------------------------------------------- |
| class       | classes que vão ser responsáveis pela maioria das funcionalidades backend do site|
| conf       | arquivos de configuração (conexão com o banco) |
| controllers       | só importa para algumas funções da página de admin, são elas: request, geração e leitura de tokens e algumas ações no banco de dados|
| entity       | são arquivos usados principalmente na pagina de admin, esses arquivos “representam” as tabelas que estão no banco de dados, é partir deles que página de admin e da página visual vão alterar e gerar conteúdo|
| libs         | arquivos de biblioteca(recomendado não mexer)|
| resource         | imagens, ícones, css e scripts baseados em js que vão ser utilizados na pagina visual e no admin|
| views         | arquivos que retém as estruturas lógicas php da página visual e do admin|


## 2. Codificação

Faz-se necessário entender que o site tem “2 endereços”, onde um é página do site e outro a página de admin. Para haja o funcionamento desses endereços é preciso de uma lógica que está presente nas linhas de código.

O `index.php` serve para carregar todos os componentes do projeto, por isso os `require_path` e `require_once`. No caso, o `require_once` vai chamar o arquivo `viewer.php`, que vai fazer o redirecionamento para a página de admin ou do site, e o `require_path` que vai chamar os arquivos responsáveis para o funcionamento das lógicas que iram vir adiante.

O `viewer.php`, como já dito antes, vai servir para redirecionar para os endereços certos. Em ambos os endereços vão existir uma mesma estrutura de organização de código e arquivo:

|site|admin|
| ----------------- | ---------------------------------------------------------------- |
| [![https://imgur.com/VJYcbG0.png](https://imgur.com/VJYcbG0.png)](https://imgur.com/VJYcbG0.png) | [![https://imgur.com/vA1XRki.png](https://imgur.com/vA1XRki.png)](https://imgur.com/vA1XRki.png) | 

O `template.php` vai servir como uma "base" que serve como container para carregar o conteúdo que alternam de acordo que as informações das páginas forem sendo atualizadas. O conteúdo do código desses arquivos se resume a criação de objetos das classes que antes foram carregadas no index.php na raiz, a chamada dos atributos e métodos desses objetos e, no caso da página do site, estruturas html misturada com códigos php que servem para acessar as tabelas do banco de dados e gerar conteúdo para o usuário. De uma forma que, da forma que são estruturados no código, ditam como vai ser o visual e funcionamento da página referente ao endereço.

**É importante destacar que o estrutura do site e do admin são feitos aqui, já o seu funcionamento são na pasta de classes**


## 3. Comentários sobre a manutenção

É logo por eu ter ficado com a responsabilidade de mudar, praticamente, só o estilo do site, eu só mexi nas estruturas acima(cheguei a nem modificar as classes, normalmente eu só entrava lá pra gerar algum log e entender o porquê de algo não funcionar) e no css. Baseando-se nisso, das funcionalidades que foram adicionadas, foram feitas de maneira procedural e não em POO(como foi feito na página de admin) e com js. **arquivo js está praticamente todo comentado**


