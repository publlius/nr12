begin; 

PRAGMA foreign_keys=OFF; 

CREATE TABLE apreciacao( 
      id  INTEGER    NOT NULL  , 
      equipamento_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(equipamento_id) REFERENCES equipamento(id)); 

 CREATE TABLE cidade( 
      id  INTEGER    NOT NULL  , 
      nome varchar  (255)   NOT NULL  , 
      estado_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(estado_id) REFERENCES estado(id)); 

 CREATE TABLE classificacao_risco( 
      id  INTEGER    NOT NULL  , 
      classificacao_risco varchar  (45)   NOT NULL  , 
      faixa varchar  (45)   NOT NULL  , 
      acao varchar  (100)   NOT NULL  , 
      cor varchar  (45)   , 
 PRIMARY KEY (id)); 

 CREATE TABLE empresa( 
      id  INTEGER    NOT NULL  , 
      unit_id int   , 
      razao_social varchar  (100)   NOT NULL  , 
      nome_fantasia varchar  (100)   NOT NULL  , 
      cnpj varchar  (45)   , 
      ie varchar  (45)   , 
      im varchar  (45)   , 
      cnae_principal varchar  (45)   , 
      cnae_secundario varchar  (45)   , 
      endereco varchar  (100)   , 
      cidade_id int  (10)   , 
      estado_id int  (10)   , 
      pais_id int  (10)   , 
 PRIMARY KEY (id)); 

 CREATE TABLE empresa_unidade( 
      id  INTEGER    NOT NULL  , 
      empresa_id int   NOT NULL  , 
      descricao_unidade varchar  (100)   NOT NULL  , 
      pais_id int   NOT NULL  , 
      estado_id int   NOT NULL  , 
      cidade_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(cidade_id) REFERENCES cidade(id),
FOREIGN KEY(estado_id) REFERENCES estado(id),
FOREIGN KEY(pais_id) REFERENCES pais(id),
FOREIGN KEY(empresa_id) REFERENCES empresa(id)); 

 CREATE TABLE equipamento( 
      id  INTEGER    NOT NULL  , 
      empresa_unidade_id int   NOT NULL  , 
      nome varchar  (200)   NOT NULL  , 
      tipo varchar  (100)   , 
      modelo varchar  (100)   , 
      numero_serie varchar  (100)   , 
      data_fabricacao date   , 
      peso double  (10,3)   , 
      capacidade varchar  (100)   , 
      setor varchar  (100)   , 
      fabricante varchar  (200)   , 
      fabricante_endereco varchar  (100)   , 
      fabricante_cidade_id int  (11)   , 
      fabricante_cep varchar  (20)   , 
      fabricante_cnpj varchar  (45)   , 
      fabricante_registro_crea varchar  (45)   , 
      tag varchar  (45)   , 
      patrimonio varchar  (45)   , 
      altura double  (6,2)   , 
      largura double  (6,2)   , 
      profundidade double  (6,2)   , 
      vista_frontal text   NOT NULL  , 
      vista_lateral_esquerda text   NOT NULL  , 
      vista_lateral_direita text   NOT NULL  , 
      vista_posterior text   NOT NULL  , 
      utilizacao text   NOT NULL  , 
      capacidade_produtiva varchar  (200)   NOT NULL  , 
      descricao_processos text   NOT NULL  , 
      numero_operadores varchar  (45)   NOT NULL  , 
      intervencoes_realizadas varchar  (45)   NOT NULL  , 
      fonte_energia varchar  (45)   , 
      tempo_acionamento varchar  (45)   , 
      tempo_ciclo varchar  (45)   , 
      tempo_parada_emergencia varchar  (45)   , 
      numero_posicoes_comando int  (3)   , 
      outros text   , 
 PRIMARY KEY (id),
FOREIGN KEY(empresa_unidade_id) REFERENCES empresa_unidade(id)); 

 CREATE TABLE estado( 
      id  INTEGER    NOT NULL  , 
      nome varchar  (255)   NOT NULL  , 
      uf varchar  (255)   NOT NULL  , 
      pais_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(pais_id) REFERENCES pais(id)); 

 CREATE TABLE f_exposicao( 
      id  INTEGER    NOT NULL  , 
      classificacao char  (2)   NOT NULL  , 
      frequencia varchar  (100)   NOT NULL  , 
 PRIMARY KEY (id)); 

 CREATE TABLE frequencia_exposicao( 
      id  INTEGER    NOT NULL  , 
      frequencia_exposicao varchar  (100)   NOT NULL  , 
      pontucao double  (5,2)   NOT NULL  , 
 PRIMARY KEY (id)); 

 CREATE TABLE hrn_fe( 
      id_  INTEGER    NOT NULL  , 
      valor double  (4,2)   NOT NULL  , 
      descricao varchar  (200)   NOT NULL  , 
      dica text   , 
 PRIMARY KEY (id_)); 

 CREATE TABLE hrn_np( 
      id  INTEGER    NOT NULL  , 
      valor double  (4,2)   NOT NULL  , 
      descricao varchar  (200)   NOT NULL  , 
      dica text   , 
 PRIMARY KEY (id)); 

 CREATE TABLE hrn_pe( 
      id  INTEGER    NOT NULL  , 
      valor double  (4,2)   NOT NULL  , 
      descricao varchar  (200)   NOT NULL  , 
      dica text   , 
 PRIMARY KEY (id)); 

 CREATE TABLE hrn_pmp( 
      id  INTEGER    NOT NULL  , 
      valor double  (4,2)   NOT NULL  , 
      descricao varchar  (200)   NOT NULL  , 
      dica text   , 
 PRIMARY KEY (id)); 

 CREATE TABLE item_norma( 
      id  INTEGER    NOT NULL  , 
      codigo_item_norma char  (10)   NOT NULL  , 
      descricao_item_norma text   NOT NULL  , 
      titulo_id int   NOT NULL  , 
      status_item_id int   NOT NULL  , 
      observacao text   , 
 PRIMARY KEY (id),
FOREIGN KEY(titulo_id) REFERENCES titulo_parecer_tecnico(id),
FOREIGN KEY(status_item_id) REFERENCES status_item(id)); 

 CREATE TABLE levantamento_risco( 
      id  INTEGER    NOT NULL  , 
      equipamento_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(equipamento_id) REFERENCES equipamento(id)); 

 CREATE TABLE medida_seguranca( 
      id  INTEGER    NOT NULL  , 
      medida_seguranca varchar  (100)   NOT NULL  , 
 PRIMARY KEY (id)); 

 CREATE TABLE pais( 
      id  INTEGER    NOT NULL  , 
      nome varchar  (255)   NOT NULL  , 
      sigla varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)); 

 CREATE TABLE parecer_tecnico( 
      id  INTEGER    NOT NULL  , 
      parecer_tecnico varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)); 

 CREATE TABLE perigo( 
      id  INTEGER    NOT NULL  , 
      tipo_perigo_id int   NOT NULL  , 
      perigo varchar  (200)   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(tipo_perigo_id) REFERENCES tipo_perigo(id)); 

 CREATE TABLE pessoas_expostas( 
      id  INTEGER    NOT NULL  , 
      pontuacao double  (5,2)   NOT NULL  , 
      faixa varchar  (45)   NOT NULL  , 
 PRIMARY KEY (id)); 

 CREATE TABLE p_evitar_perigo( 
      id  INTEGER    NOT NULL  , 
      classificacao char  (2)   NOT NULL  , 
      possibilidade_evitar varchar  (100)   NOT NULL  , 
 PRIMARY KEY (id)); 

 CREATE TABLE ponto( 
      id  INTEGER    NOT NULL  , 
      apreciacao_id int   NOT NULL  , 
      vista_ponto text   NOT NULL  , 
      localizacao_ponto varchar  (100)   NOT NULL  , 
      severidade_ferimento char  (2)   , 
      tipo_perigo_id int   NOT NULL  , 
      frequencia_exposicao char  (2)   , 
      possibilidade_evitar char  (2)   , 
      parecer_extra_norma text   , 
      possiveis_solucoes text   , 
 PRIMARY KEY (id),
FOREIGN KEY(apreciacao_id) REFERENCES apreciacao(id),
FOREIGN KEY(tipo_perigo_id) REFERENCES tipo_perigo(id)); 

 CREATE TABLE ponto_parecer_tecnico( 
      id  INTEGER    NOT NULL  , 
      titulo_parecer_tecnico_id int   NOT NULL  , 
      item_norma_id int   NOT NULL  , 
      ponto_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(titulo_parecer_tecnico_id) REFERENCES titulo_parecer_tecnico(id),
FOREIGN KEY(item_norma_id) REFERENCES item_norma(id),
FOREIGN KEY(ponto_id) REFERENCES ponto(id)); 

 CREATE TABLE ponto_perigo( 
      id  INTEGER    NOT NULL  , 
      apreciacao_id int   NOT NULL  , 
      ponto_id int   NOT NULL  , 
      perigo_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(apreciacao_id) REFERENCES apreciacao(id),
FOREIGN KEY(perigo_id) REFERENCES perigo(id),
FOREIGN KEY(ponto_id) REFERENCES ponto(id)); 

 CREATE TABLE ponto_risco( 
      id  INTEGER    NOT NULL  , 
      apreciacao_id int   NOT NULL  , 
      ponto_id int   NOT NULL  , 
      risco_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(apreciacao_id) REFERENCES apreciacao(id),
FOREIGN KEY(risco_id) REFERENCES risco(id),
FOREIGN KEY(ponto_id) REFERENCES ponto(id)); 

 CREATE TABLE ponto_sistema_seguranca( 
      id  INTEGER    NOT NULL  , 
      ponto_id int   NOT NULL  , 
      sistema_seguranca_tipo_id int   NOT NULL  , 
      sistema_seguranca_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(sistema_seguranca_tipo_id) REFERENCES sistema_seguranca_tipo(id),
FOREIGN KEY(sistema_seguranca_id) REFERENCES sistema_seguranca(id),
FOREIGN KEY(ponto_id) REFERENCES ponto(id)); 

 CREATE TABLE probabilidade_exposicao( 
      id  INTEGER    NOT NULL  , 
      pontuacao double  (5,2)   NOT NULL  , 
      probabilidade_exposicao varchar  (45)   NOT NULL  , 
 PRIMARY KEY (id)); 

 CREATE TABLE probabilidade_exposicao_detalhe( 
      id  INTEGER    NOT NULL  , 
      probabilidade_exposicao_detalhe varchar  (200)   NOT NULL  , 
      probabilidade_exposicao_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(probabilidade_exposicao_id) REFERENCES probabilidade_exposicao(id)); 

 CREATE TABLE probabilidade_perda( 
      id  INTEGER    NOT NULL  , 
      pontuacao double  (5,2)   NOT NULL  , 
      probabilidade_perda varchar  (100)   NOT NULL  , 
 PRIMARY KEY (id)); 

 CREATE TABLE risco( 
      id  INTEGER    NOT NULL  , 
      tipo_perigo_id int   NOT NULL  , 
      risco varchar  (200)   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(tipo_perigo_id) REFERENCES tipo_perigo(id)); 

 CREATE TABLE s_ferimento( 
      id  INTEGER    NOT NULL  , 
      classificacao char  (2)   NOT NULL  , 
      severidade varchar  (100)   NOT NULL  , 
 PRIMARY KEY (id)); 

 CREATE TABLE sistema_seguranca( 
      id  INTEGER    NOT NULL  , 
      sistema_seguranca varchar  (100)   NOT NULL  , 
 PRIMARY KEY (id)); 

 CREATE TABLE sistema_seguranca_tipo( 
      id  INTEGER    NOT NULL  , 
      sistema_seguranca_id int   NOT NULL  , 
      descricao_tipo varchar  (200)   NOT NULL  , 
      hint text   , 
 PRIMARY KEY (id),
FOREIGN KEY(sistema_seguranca_id) REFERENCES sistema_seguranca(id)); 

 CREATE TABLE status_item( 
      id  INTEGER    NOT NULL  , 
      status_item varchar  (45)   NOT NULL  , 
 PRIMARY KEY (id)); 

 CREATE TABLE tipo_perigo( 
      id  INTEGER    NOT NULL  , 
      tipo_perigo varchar  (100)   NOT NULL  , 
 PRIMARY KEY (id)); 

 CREATE TABLE titulo_parecer_tecnico( 
      id  INTEGER    NOT NULL  , 
      titulo_parecer_tecnico varchar  (100)   NOT NULL  , 
 PRIMARY KEY (id)); 

  
 commit;