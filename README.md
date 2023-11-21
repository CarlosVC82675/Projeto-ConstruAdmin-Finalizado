Mudei coisa para kct não vou lembrar de tudo porque só começei a anotar anteontem

Resumindo terminei as funçoes de obra e projeto(foto e arquivo)
Mudei alguns coisas no migrations para satifazer algumas funçoes, principalmente do arquivo, por exemplo tipo(para saber se é foto ou arquivo) e extensao para pegar a extensao do arquivo
Models eu apenas coloquei os fillables novos para cadastro
Validação back e front de obras e projeto feitas e testadas
Fiz alguns ajuste no filesystem no meu projeto, para alocar os arquivos e criar link para o meu storage de arquivos, possivel de configuração na integração
Alterei também o fuso horario do laravel, nas config -> timezone, onde coloquei Sao paulo, para que o timestamp pegue o horario de sao paulo, possivel de mudança

Anotações de mudanças que fiz
-Configuração do file-> campos hidden tipo e Obras_IdObras adicionados
-Migration Arquivo adicionado caminho,tipo e extensao
-extensões aceitas (possivel de mudanças):Fotos: png,jpg,jpeg | Arquivos: pdf,rvt,dwg
-Enum trocados de CAIXA ALTA para caixa pequena? sei lá se é caixa pequena, agora ta normal
-Validações para required,max,regex e unique feitas em obras e arquivos
-Problema da edição de obras com mesmo valor resolvido Eu🤝Carlos
-Deletar arquivos agora são deletados também na pasta storage/arquivos para evitar lentidão


