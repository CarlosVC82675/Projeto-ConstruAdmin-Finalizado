Opa!
Malz pela demora, jquery e ajax são duas desgraças sem precendentes
obs: se vc estiver usando ajax para ativar as requisições, e estiver tendo o erro de get method no bla bla bla, escreve essa linha no seu success do ajax
  success: function (response) {
        console.log('Requisição POST bem-sucedida:');
        updateModalImages();
          
    if (response.redirect) {
      
      window.location.href = response.redirect;
    } else {
     
      console.log(response);
    }
}
e depois refaz o seu redirect no controller para aceitar json,  return response()->json(['redirect' => route('Atividade.Listar')]);
pronto, deve dar agr, poderia explicar...mas n vou, demorei 4h para achar essa porra, ent q se foda, to cansado.

ENFIM
transformei todas as view praticamente em modais, ent ignora o criar e editar atv la, só oq importa é a view Listar_atv.
então é isso, transformei tudo em modal que tem os dados gerenciados por jquery junto com ajax para requisições 
eu tambem modifiquei um pouco o layoult base da parte de dentro da obra, como colocar uma div que engloba tudo e fazer com que o navbar fique fixo como o fixed-top ou sla oq
ent se estiver estranho o visual da minha parte, vale a pena olhar o meu layoult dentro, n tem mts mudanças, só isso que é para deixar mais dinamico mas, sem isso algumas
coisas não encaixam

Tem as novas migrations, models, controller que são

Comentarios
Cards
Atividades ( atualizada )
Lista de atividade ( Atualizada )
então vale a pena substituir essas coisas ai
------
Sobre os erros, bem, potencialmente podem dar 3 erros diferentes

1 - unexpected token '<' ou ':' fica sv, esse token ai n existe, oque ta acontecendo de vdd é que o auth no controller de atividades não ta funfando por algum motivo
não pude testar ele então segui a logica padrão de qualquer auth, então pode ser que eu tenha escrito algo errado
2 - imagem not found, isso ai rola quando vc não esta com o link do storage ativo, ia é só abrir seu prompt e rodar isso aqui: php artisan storage:link que ai deve resolver,
obs: talvez vc tenha que rodar esse comando duas vezes...ou sla, eu q sou azarado e perdi 2h pq esse comando rodou...mas n acionou da primeira vez...foda
3 - dependencias out of date, ai é mais foda msm, como eu disse antes, to usando a ultima versão de TUDO, então talvez não seja compativel com a que voce tem ai na sua maquina
ou talvez seja, tem um leque de versões aonde tudo funciona junto, ANYWAYS, ta tudo na minha view de Listar_atividade, passei tudo para la e deixei ate o layout dentro sem nenhum
link ou script, aqui deu tudo certo
4 - Ah! talvez o crfsc...algo assim, de erro...sla, é bem impossivel..mas sla, sou azarado.
5 - vou mandar aqui um video de como ta funcionando na minha maquina...se eu conseguir, ou eu mando no seu wtts, tanto faz.

Coisas para fazer...bem, tudo eu acho
- permitir atualização e delete de mensagens
- organizar as mensagens de erro, tve uma hr da minha vida em q eu basicamente só tva usando ou o inspecionar ou o log do laravel, ent se vc n usar nenhum dos dois fica foda
- fazer as camadas de serviços e tauz
- fazer o botão de alert funcionar, usar css no js com documents do mdb é um porre, nunca achei q seria dificil fazer uma bolinha vermelha piscar
- estilizar melhor a area de comentarios
- fazer aba de relatorios de atividades 
- fazer o anexo aceitar varias fotos ( ta praticamente pronto, só falta eu descomentar as linhas que fazer isso para poder testar )
- permitir que a pessou possa enviar videos no anexo, talvez vire um atributo ou tabela nova isso aqui, e talvez eu use uma biblioteca a parte para isso
- n lembro se eu apaguei minhas antigas rotas...provavelmente n mas,elas vão estar comentadas, eu acabei fazendo as rotas do 0...eu odeio ajax....
- ah, isso aqui ta no meu seeder: 


<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class link extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    
        // Executa o comando php artisan storage:link
        Artisan::call('storage:link');

        // Restante do código do seeder
    }
    }
eu sinceramente não sei se funciona, mas na teoria deveria, isso automatiza o lance do link

bem...é isso, eu sei que tu vai me chamar pq vai dar alguns erros por causa das versões, ent é aquilo, é só chamar no wtts, devo ficar ate 7h da manhã acordado fazendo 
o banco, então devo acordar 13:30. cada dia que passa perdendo parte da alma....


anyway,se n tiver funcionando o bootstrap, veja se, tem isso no seu package.json: {
  "dependencies": {
    "bootstrap": "^5.3.2",
    "mdb-ui-kit": "^7.0.0"
  }
}
veja se no package.lock as dependencias do mdb ui kit estão la, as versions certas os resolveds certos, o meu esta literalmente assim (ignora o class, coloquei para o git
reconhecer como codigo:
 public function void(){
  "name": "vamo-la",
  "lockfileVersion": 2,
  "requires": true,
  "packages": {
    "": {
      "dependencies": {
        "bootstrap": "^5.3.2",
        "mdb-ui-kit": "^7.0.0"
      }
    },
    "node_modules/@popperjs/core": {
      "version": "2.11.8",
      "resolved": "https://registry.npmjs.org/@popperjs/core/-/core-2.11.8.tgz",
      "integrity": "sha512-P1st0aksCrn9sGZhp8GMYwBnQsbvAWsZAX44oXNNvLHGqAOcoVxmjZiohstwQ7SqKnbR47akdNi+uleWD8+g6A==",
      "peer": true,
      "funding": {
        "type": "opencollective",
        "url": "https://opencollective.com/popperjs"
      }
    },
    "node_modules/bootstrap": {
      "version": "5.3.2",
      "resolved": "https://registry.npmjs.org/bootstrap/-/bootstrap-5.3.2.tgz",
      "integrity": "sha512-D32nmNWiQHo94BKHLmOrdjlL05q1c8oxbtBphQFb9Z5to6eGRDCm0QgeaZ4zFBHzfg2++rqa2JkqCcxDy0sH0g==",
      "funding": [
        {
          "type": "github",
          "url": "https://github.com/sponsors/twbs"
        },
        {
          "type": "opencollective",
          "url": "https://opencollective.com/bootstrap"
        }
      ],
      "peerDependencies": {
        "@popperjs/core": "^2.11.8"
      }
    },
    "node_modules/mdb-ui-kit": {
      "version": "7.0.0",
      "resolved": "https://registry.npmjs.org/mdb-ui-kit/-/mdb-ui-kit-7.0.0.tgz",
      "integrity": "sha512-I95FVVIZF2XCLmGq8XjOyQHP03eqXkhi2g4YDRxZiWz81zxJ8N+/38cEold3t079QMisLYh04FHi+VHhbLedzw=="
    }
  },
  "dependencies": {
    "@popperjs/core": {
      "version": "2.11.8",
      "resolved": "https://registry.npmjs.org/@popperjs/core/-/core-2.11.8.tgz",
      "integrity": "sha512-P1st0aksCrn9sGZhp8GMYwBnQsbvAWsZAX44oXNNvLHGqAOcoVxmjZiohstwQ7SqKnbR47akdNi+uleWD8+g6A==",
      "peer": true
    },
    "bootstrap": {
      "version": "5.3.2",
      "resolved": "https://registry.npmjs.org/bootstrap/-/bootstrap-5.3.2.tgz",
      "integrity": "sha512-D32nmNWiQHo94BKHLmOrdjlL05q1c8oxbtBphQFb9Z5to6eGRDCm0QgeaZ4zFBHzfg2++rqa2JkqCcxDy0sH0g==",
      "requires": {}
    },
    "mdb-ui-kit": {
      "version": "7.0.0",
      "resolved": "https://registry.npmjs.org/mdb-ui-kit/-/mdb-ui-kit-7.0.0.tgz",
      "integrity": "sha512-I95FVVIZF2XCLmGq8XjOyQHP03eqXkhi2g4YDRxZiWz81zxJ8N+/38cEold3t079QMisLYh04FHi+VHhbLedzw=="
    }
  }
}


e por ultimo veja se nos node modules abaixo do database, esta o arquivos do mdb ui kit


