begin; 

CREATE TABLE apreciacao( 
      id  SERIAL    NOT NULL  , 
      equipamento_id integer   NOT NULL  , 
 PRIMARY KEY (id)); 

 CREATE TABLE cidade( 
      id  SERIAL    NOT NULL  , 
      nome varchar  (255)   NOT NULL  , 
      estado_id integer   NOT NULL  , 
 PRIMARY KEY (id)); 

 CREATE TABLE classificacao_risco( 
      id  SERIAL    NOT NULL  , 
      classificacao_risco varchar  (45)   NOT NULL  , 
      faixa varchar  (45)   NOT NULL  , 
      acao varchar  (100)   NOT NULL  , 
      cor varchar  (45)   , 
 PRIMARY KEY (id)); 

 CREATE TABLE empresa( 
      id  SERIAL    NOT NULL  , 
      unit_id integer   , 
      razao_social varchar  (100)   NOT NULL  , 
      nome_fantasia varchar  (100)   NOT NULL  , 
      cnpj varchar  (45)   , 
      ie varchar  (45)   , 
      im varchar  (45)   , 
      cnae_principal varchar  (45)   , 
      cnae_secundario varchar  (45)   , 
      endereco varchar  (100)   , 
      cidade_id integer   , 
      estado_id integer   , 
      pais_id integer   , 
 PRIMARY KEY (id)); 

 CREATE TABLE empresa_unidade( 
      id  SERIAL    NOT NULL  , 
      empresa_id integer   NOT NULL  , 
      descricao_unidade varchar  (100)   NOT NULL  , 
      pais_id integer   NOT NULL  , 
      estado_id integer   NOT NULL  , 
      cidade_id integer   NOT NULL  , 
 PRIMARY KEY (id)); 

 CREATE TABLE equipamento( 
      id  SERIAL    NOT NULL  , 
      empresa_unidade_id integer   NOT NULL  , 
      nome varchar  (200)   NOT NULL  , 
      tipo varchar  (100)   , 
      modelo varchar  (100)   , 
      numero_serie varchar  (100)   , 
      data_fabricacao date   , 
      peso float   , 
      capacidade varchar  (100)   , 
      setor varchar  (100)   , 
      fabricante varchar  (200)   , 
      fabricante_endereco varchar  (100)   , 
      fabricante_cidade_id integer   , 
      fabricante_cep varchar  (20)   , 
      fabricante_cnpj varchar  (45)   , 
      fabricante_registro_crea varchar  (45)   , 
      tag varchar  (45)   , 
      patrimonio varchar  (45)   , 
      altura float   , 
      largura float   , 
      profundidade float   , 
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
      numero_posicoes_comando integer   , 
      outros text   , 
 PRIMARY KEY (id)); 

 CREATE TABLE estado( 
      id  SERIAL    NOT NULL  , 
      nome varchar  (255)   NOT NULL  , 
      uf varchar  (255)   NOT NULL  , 
      pais_id integer   NOT NULL  , 
 PRIMARY KEY (id)); 

 CREATE TABLE f_exposicao( 
      id  SERIAL    NOT NULL  , 
      classificacao char  (2)   NOT NULL  , 
      frequencia varchar  (100)   NOT NULL  , 
 PRIMARY KEY (id)); 

 CREATE TABLE frequencia_exposicao( 
      id  SERIAL    NOT NULL  , 
      frequencia_exposicao varchar  (100)   NOT NULL  , 
      pontucao float   NOT NULL  , 
 PRIMARY KEY (id)); 

 CREATE TABLE hrn_fe( 
      id_  SERIAL    NOT NULL  , 
      valor float   NOT NULL  , 
      descricao varchar  (200)   NOT NULL  , 
      dica text   , 
 PRIMARY KEY (id_)); 

 CREATE TABLE hrn_np( 
      id  SERIAL    NOT NULL  , 
      valor float   NOT NULL  , 
      descricao varchar  (200)   NOT NULL  , 
      dica text   , 
 PRIMARY KEY (id)); 

 CREATE TABLE hrn_pe( 
      id  SERIAL    NOT NULL  , 
      valor float   NOT NULL  , 
      descricao varchar  (200)   NOT NULL  , 
      dica text   , 
 PRIMARY KEY (id)); 

 CREATE TABLE hrn_pmp( 
      id  SERIAL    NOT NULL  , 
      valor float   NOT NULL  , 
      descricao varchar  (200)   NOT NULL  , 
      dica text   , 
 PRIMARY KEY (id)); 

 CREATE TABLE item_norma( 
      id  SERIAL    NOT NULL  , 
      codigo_item_norma char  (10)   NOT NULL  , 
      descricao_item_norma text   NOT NULL  , 
      titulo_id integer   NOT NULL  , 
      status_item_id integer   NOT NULL  , 
      observacao text   , 
 PRIMARY KEY (id)); 

 CREATE TABLE levantamento_risco( 
      id  SERIAL    NOT NULL  , 
      equipamento_id integer   NOT NULL  , 
 PRIMARY KEY (id)); 

 CREATE TABLE medida_seguranca( 
      id  SERIAL    NOT NULL  , 
      medida_seguranca varchar  (100)   NOT NULL  , 
 PRIMARY KEY (id)); 

 CREATE TABLE pais( 
      id  SERIAL    NOT NULL  , 
      nome varchar  (255)   NOT NULL  , 
      sigla varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)); 

 CREATE TABLE parecer_tecnico( 
      id  SERIAL    NOT NULL  , 
      parecer_tecnico varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)); 

 CREATE TABLE perigo( 
      id  SERIAL    NOT NULL  , 
      tipo_perigo_id integer   NOT NULL  , 
      perigo varchar  (200)   NOT NULL  , 
 PRIMARY KEY (id)); 

 CREATE TABLE pessoas_expostas( 
      id  SERIAL    NOT NULL  , 
      pontuacao float   NOT NULL  , 
      faixa varchar  (45)   NOT NULL  , 
 PRIMARY KEY (id)); 

 CREATE TABLE p_evitar_perigo( 
      id  SERIAL    NOT NULL  , 
      classificacao char  (2)   NOT NULL  , 
      possibilidade_evitar varchar  (100)   NOT NULL  , 
 PRIMARY KEY (id)); 

 CREATE TABLE ponto( 
      id  SERIAL    NOT NULL  , 
      apreciacao_id integer   NOT NULL  , 
      vista_ponto text   NOT NULL  , 
      localizacao_ponto varchar  (100)   NOT NULL  , 
      severidade_ferimento char  (2)   , 
      tipo_perigo_id integer   NOT NULL  , 
      frequencia_exposicao char  (2)   , 
      possibilidade_evitar char  (2)   , 
      parecer_extra_norma text   , 
      possiveis_solucoes text   , 
 PRIMARY KEY (id)); 

 CREATE TABLE ponto_parecer_tecnico( 
      id  SERIAL    NOT NULL  , 
      titulo_parecer_tecnico_id integer   NOT NULL  , 
      item_norma_id integer   NOT NULL  , 
      ponto_id integer   NOT NULL  , 
 PRIMARY KEY (id)); 

 CREATE TABLE ponto_perigo( 
      id  SERIAL    NOT NULL  , 
      apreciacao_id integer   NOT NULL  , 
      ponto_id integer   NOT NULL  , 
      perigo_id integer   NOT NULL  , 
 PRIMARY KEY (id)); 

 CREATE TABLE ponto_risco( 
      id  SERIAL    NOT NULL  , 
      apreciacao_id integer   NOT NULL  , 
      ponto_id integer   NOT NULL  , 
      risco_id integer   NOT NULL  , 
 PRIMARY KEY (id)); 

 CREATE TABLE ponto_sistema_seguranca( 
      id  SERIAL    NOT NULL  , 
      ponto_id integer   NOT NULL  , 
      sistema_seguranca_tipo_id integer   NOT NULL  , 
      sistema_seguranca_id integer   NOT NULL  , 
 PRIMARY KEY (id)); 

 CREATE TABLE probabilidade_exposicao( 
      id  SERIAL    NOT NULL  , 
      pontuacao float   NOT NULL  , 
      probabilidade_exposicao varchar  (45)   NOT NULL  , 
 PRIMARY KEY (id)); 

 CREATE TABLE probabilidade_exposicao_detalhe( 
      id  SERIAL    NOT NULL  , 
      probabilidade_exposicao_detalhe varchar  (200)   NOT NULL  , 
      probabilidade_exposicao_id integer   NOT NULL  , 
 PRIMARY KEY (id)); 

 CREATE TABLE probabilidade_perda( 
      id  SERIAL    NOT NULL  , 
      pontuacao float   NOT NULL  , 
      probabilidade_perda varchar  (100)   NOT NULL  , 
 PRIMARY KEY (id)); 

 CREATE TABLE risco( 
      id  SERIAL    NOT NULL  , 
      tipo_perigo_id integer   NOT NULL  , 
      risco varchar  (200)   NOT NULL  , 
 PRIMARY KEY (id)); 

 CREATE TABLE s_ferimento( 
      id  SERIAL    NOT NULL  , 
      classificacao char  (2)   NOT NULL  , 
      severidade varchar  (100)   NOT NULL  , 
 PRIMARY KEY (id)); 

 CREATE TABLE sistema_seguranca( 
      id  SERIAL    NOT NULL  , 
      sistema_seguranca varchar  (100)   NOT NULL  , 
 PRIMARY KEY (id)); 

 CREATE TABLE sistema_seguranca_tipo( 
      id  SERIAL    NOT NULL  , 
      sistema_seguranca_id integer   NOT NULL  , 
      descricao_tipo varchar  (200)   NOT NULL  , 
      hint text   , 
 PRIMARY KEY (id)); 

 CREATE TABLE status_item( 
      id  SERIAL    NOT NULL  , 
      status_item varchar  (45)   NOT NULL  , 
 PRIMARY KEY (id)); 

 CREATE TABLE tipo_perigo( 
      id  SERIAL    NOT NULL  , 
      tipo_perigo varchar  (100)   NOT NULL  , 
 PRIMARY KEY (id)); 

 CREATE TABLE titulo_parecer_tecnico( 
      id  SERIAL    NOT NULL  , 
      titulo_parecer_tecnico varchar  (100)   NOT NULL  , 
 PRIMARY KEY (id)); 

  
 ALTER TABLE apreciacao ADD CONSTRAINT fk_apreciacao_1 FOREIGN KEY (equipamento_id) references equipamento(id); 
ALTER TABLE cidade ADD CONSTRAINT fk_cidade_1 FOREIGN KEY (estado_id) references estado(id); 
ALTER TABLE empresa_unidade ADD CONSTRAINT fk_empresa_unidade_4 FOREIGN KEY (cidade_id) references cidade(id); 
ALTER TABLE empresa_unidade ADD CONSTRAINT fk_empresa_unidade_3 FOREIGN KEY (estado_id) references estado(id); 
ALTER TABLE empresa_unidade ADD CONSTRAINT fk_empresa_unidade_2 FOREIGN KEY (pais_id) references pais(id); 
ALTER TABLE empresa_unidade ADD CONSTRAINT fk_empresa_unidade_1 FOREIGN KEY (empresa_id) references empresa(id); 
ALTER TABLE equipamento ADD CONSTRAINT fk_equipamento_1 FOREIGN KEY (empresa_unidade_id) references empresa_unidade(id); 
ALTER TABLE estado ADD CONSTRAINT fk_estado_1 FOREIGN KEY (pais_id) references pais(id); 
ALTER TABLE item_norma ADD CONSTRAINT fk_item_norma_2 FOREIGN KEY (titulo_id) references titulo_parecer_tecnico(id); 
ALTER TABLE item_norma ADD CONSTRAINT fk_item_norma_1 FOREIGN KEY (status_item_id) references status_item(id); 
ALTER TABLE levantamento_risco ADD CONSTRAINT fk_levantamento_risco_1 FOREIGN KEY (equipamento_id) references equipamento(id); 
ALTER TABLE perigo ADD CONSTRAINT fk_perigo_1 FOREIGN KEY (tipo_perigo_id) references tipo_perigo(id); 
ALTER TABLE ponto ADD CONSTRAINT fk_ponto_3 FOREIGN KEY (apreciacao_id) references apreciacao(id); 
ALTER TABLE ponto ADD CONSTRAINT fk_ponto_2 FOREIGN KEY (tipo_perigo_id) references tipo_perigo(id); 
ALTER TABLE ponto_parecer_tecnico ADD CONSTRAINT fk_ponto_parecer_tecnico_3 FOREIGN KEY (titulo_parecer_tecnico_id) references titulo_parecer_tecnico(id); 
ALTER TABLE ponto_parecer_tecnico ADD CONSTRAINT fk_ponto_parecer_tecnico_2 FOREIGN KEY (item_norma_id) references item_norma(id); 
ALTER TABLE ponto_parecer_tecnico ADD CONSTRAINT fk_ponto_parecer_tecnico_1 FOREIGN KEY (ponto_id) references ponto(id); 
ALTER TABLE ponto_perigo ADD CONSTRAINT fk_ponto_perigo_3 FOREIGN KEY (apreciacao_id) references apreciacao(id); 
ALTER TABLE ponto_perigo ADD CONSTRAINT fk_ponto_perigo_2 FOREIGN KEY (perigo_id) references perigo(id); 
ALTER TABLE ponto_perigo ADD CONSTRAINT fk_ponto_perigo_1 FOREIGN KEY (ponto_id) references ponto(id); 
ALTER TABLE ponto_risco ADD CONSTRAINT fk_ponto_risco_3 FOREIGN KEY (apreciacao_id) references apreciacao(id); 
ALTER TABLE ponto_risco ADD CONSTRAINT fk_ponto_risco_2 FOREIGN KEY (risco_id) references risco(id); 
ALTER TABLE ponto_risco ADD CONSTRAINT fk_ponto_risco_1 FOREIGN KEY (ponto_id) references ponto(id); 
ALTER TABLE ponto_sistema_seguranca ADD CONSTRAINT fk_ponto_sistema_seguranca_3 FOREIGN KEY (sistema_seguranca_tipo_id) references sistema_seguranca_tipo(id); 
ALTER TABLE ponto_sistema_seguranca ADD CONSTRAINT fk_ponto_sistema_seguranca_2 FOREIGN KEY (sistema_seguranca_id) references sistema_seguranca(id); 
ALTER TABLE ponto_sistema_seguranca ADD CONSTRAINT fk_ponto_sistema_seguranca_1 FOREIGN KEY (ponto_id) references ponto(id); 
ALTER TABLE probabilidade_exposicao_detalhe ADD CONSTRAINT fk_probabilidade_exposicao_detalhe_1 FOREIGN KEY (probabilidade_exposicao_id) references probabilidade_exposicao(id); 
ALTER TABLE risco ADD CONSTRAINT fk_risco_1 FOREIGN KEY (tipo_perigo_id) references tipo_perigo(id); 
ALTER TABLE sistema_seguranca_tipo ADD CONSTRAINT fk_sistema_seguranca_tipo_1 FOREIGN KEY (sistema_seguranca_id) references sistema_seguranca(id); 
 
 commit;