begin; 

CREATE TABLE apreciacao( 
      id number(10)    NOT NULL , 
      equipamento_id number(10)    NOT NULL , 
 PRIMARY KEY (id)); 

 CREATE TABLE cidade( 
      id number(10)    NOT NULL , 
      nome varchar  (255)    NOT NULL , 
      estado_id number(10)    NOT NULL , 
 PRIMARY KEY (id)); 

 CREATE TABLE classificacao_risco( 
      id number(10)    NOT NULL , 
      classificacao_risco varchar  (45)    NOT NULL , 
      faixa varchar  (45)    NOT NULL , 
      acao varchar  (100)    NOT NULL , 
      cor varchar  (45)   , 
 PRIMARY KEY (id)); 

 CREATE TABLE empresa( 
      id number(10)    NOT NULL , 
      unit_id number(10)   , 
      razao_social varchar  (100)    NOT NULL , 
      nome_fantasia varchar  (100)    NOT NULL , 
      cnpj varchar  (45)   , 
      ie varchar  (45)   , 
      im varchar  (45)   , 
      cnae_principal varchar  (45)   , 
      cnae_secundario varchar  (45)   , 
      endereco varchar  (100)   , 
      cidade_id number(10)  (10)   , 
      estado_id number(10)  (10)   , 
      pais_id number(10)  (10)   , 
 PRIMARY KEY (id)); 

 CREATE TABLE empresa_unidade( 
      id number(10)    NOT NULL , 
      empresa_id number(10)    NOT NULL , 
      descricao_unidade varchar  (100)    NOT NULL , 
      pais_id number(10)    NOT NULL , 
      estado_id number(10)    NOT NULL , 
      cidade_id number(10)    NOT NULL , 
 PRIMARY KEY (id)); 

 CREATE TABLE equipamento( 
      id number(10)    NOT NULL , 
      empresa_unidade_id number(10)    NOT NULL , 
      nome varchar  (200)    NOT NULL , 
      tipo varchar  (100)   , 
      modelo varchar  (100)   , 
      numero_serie varchar  (100)   , 
      data_fabricacao date   , 
      peso binary_double  (10,3)   , 
      capacidade varchar  (100)   , 
      setor varchar  (100)   , 
      fabricante varchar  (200)   , 
      fabricante_endereco varchar  (100)   , 
      fabricante_cidade_id number(10)  (11)   , 
      fabricante_cep varchar  (20)   , 
      fabricante_cnpj varchar  (45)   , 
      fabricante_registro_crea varchar  (45)   , 
      tag varchar  (45)   , 
      patrimonio varchar  (45)   , 
      altura binary_double  (6,2)   , 
      largura binary_double  (6,2)   , 
      profundidade binary_double  (6,2)   , 
      vista_frontal CLOB    NOT NULL , 
      vista_lateral_esquerda CLOB    NOT NULL , 
      vista_lateral_direita CLOB    NOT NULL , 
      vista_posterior CLOB    NOT NULL , 
      utilizacao CLOB    NOT NULL , 
      capacidade_produtiva varchar  (200)    NOT NULL , 
      descricao_processos CLOB    NOT NULL , 
      numero_operadores varchar  (45)    NOT NULL , 
      intervencoes_realizadas varchar  (45)    NOT NULL , 
      fonte_energia varchar  (45)   , 
      tempo_acionamento varchar  (45)   , 
      tempo_ciclo varchar  (45)   , 
      tempo_parada_emergencia varchar  (45)   , 
      numero_posicoes_comando number(10)  (3)   , 
      outros CLOB   , 
 PRIMARY KEY (id)); 

 CREATE TABLE estado( 
      id number(10)    NOT NULL , 
      nome varchar  (255)    NOT NULL , 
      uf varchar  (255)    NOT NULL , 
      pais_id number(10)    NOT NULL , 
 PRIMARY KEY (id)); 

 CREATE TABLE f_exposicao( 
      id number(10)    NOT NULL , 
      classificacao char  (2)    NOT NULL , 
      frequencia varchar  (100)    NOT NULL , 
 PRIMARY KEY (id)); 

 CREATE TABLE frequencia_exposicao( 
      id number(10)    NOT NULL , 
      frequencia_exposicao varchar  (100)    NOT NULL , 
      pontucao binary_double  (5,2)    NOT NULL , 
 PRIMARY KEY (id)); 

 CREATE TABLE hrn_fe( 
      id_ number(10)    NOT NULL , 
      valor binary_double  (4,2)    NOT NULL , 
      descricao varchar  (200)    NOT NULL , 
      dica CLOB   , 
 PRIMARY KEY (id_)); 

 CREATE TABLE hrn_np( 
      id number(10)    NOT NULL , 
      valor binary_double  (4,2)    NOT NULL , 
      descricao varchar  (200)    NOT NULL , 
      dica CLOB   , 
 PRIMARY KEY (id)); 

 CREATE TABLE hrn_pe( 
      id number(10)    NOT NULL , 
      valor binary_double  (4,2)    NOT NULL , 
      descricao varchar  (200)    NOT NULL , 
      dica CLOB   , 
 PRIMARY KEY (id)); 

 CREATE TABLE hrn_pmp( 
      id number(10)    NOT NULL , 
      valor binary_double  (4,2)    NOT NULL , 
      descricao varchar  (200)    NOT NULL , 
      dica CLOB   , 
 PRIMARY KEY (id)); 

 CREATE TABLE item_norma( 
      id number(10)    NOT NULL , 
      codigo_item_norma char  (10)    NOT NULL , 
      descricao_item_norma CLOB    NOT NULL , 
      titulo_id number(10)    NOT NULL , 
      status_item_id number(10)    NOT NULL , 
      observacao CLOB   , 
 PRIMARY KEY (id)); 

 CREATE TABLE levantamento_risco( 
      id number(10)    NOT NULL , 
      equipamento_id number(10)    NOT NULL , 
 PRIMARY KEY (id)); 

 CREATE TABLE medida_seguranca( 
      id number(10)    NOT NULL , 
      medida_seguranca varchar  (100)    NOT NULL , 
 PRIMARY KEY (id)); 

 CREATE TABLE pais( 
      id number(10)    NOT NULL , 
      nome varchar  (255)    NOT NULL , 
      sigla varchar  (255)    NOT NULL , 
 PRIMARY KEY (id)); 

 CREATE TABLE parecer_tecnico( 
      id number(10)    NOT NULL , 
      parecer_tecnico varchar  (255)    NOT NULL , 
 PRIMARY KEY (id)); 

 CREATE TABLE perigo( 
      id number(10)    NOT NULL , 
      tipo_perigo_id number(10)    NOT NULL , 
      perigo varchar  (200)    NOT NULL , 
 PRIMARY KEY (id)); 

 CREATE TABLE pessoas_expostas( 
      id number(10)    NOT NULL , 
      pontuacao binary_double  (5,2)    NOT NULL , 
      faixa varchar  (45)    NOT NULL , 
 PRIMARY KEY (id)); 

 CREATE TABLE p_evitar_perigo( 
      id number(10)    NOT NULL , 
      classificacao char  (2)    NOT NULL , 
      possibilidade_evitar varchar  (100)    NOT NULL , 
 PRIMARY KEY (id)); 

 CREATE TABLE ponto( 
      id number(10)    NOT NULL , 
      apreciacao_id number(10)    NOT NULL , 
      vista_ponto CLOB    NOT NULL , 
      localizacao_ponto varchar  (100)    NOT NULL , 
      severidade_ferimento char  (2)   , 
      tipo_perigo_id number(10)    NOT NULL , 
      frequencia_exposicao char  (2)   , 
      possibilidade_evitar char  (2)   , 
      parecer_extra_norma CLOB   , 
      possiveis_solucoes CLOB   , 
 PRIMARY KEY (id)); 

 CREATE TABLE ponto_parecer_tecnico( 
      id number(10)    NOT NULL , 
      titulo_parecer_tecnico_id number(10)    NOT NULL , 
      item_norma_id number(10)    NOT NULL , 
      ponto_id number(10)    NOT NULL , 
 PRIMARY KEY (id)); 

 CREATE TABLE ponto_perigo( 
      id number(10)    NOT NULL , 
      apreciacao_id number(10)    NOT NULL , 
      ponto_id number(10)    NOT NULL , 
      perigo_id number(10)    NOT NULL , 
 PRIMARY KEY (id)); 

 CREATE TABLE ponto_risco( 
      id number(10)    NOT NULL , 
      apreciacao_id number(10)    NOT NULL , 
      ponto_id number(10)    NOT NULL , 
      risco_id number(10)    NOT NULL , 
 PRIMARY KEY (id)); 

 CREATE TABLE ponto_sistema_seguranca( 
      id number(10)    NOT NULL , 
      ponto_id number(10)    NOT NULL , 
      sistema_seguranca_tipo_id number(10)    NOT NULL , 
      sistema_seguranca_id number(10)    NOT NULL , 
 PRIMARY KEY (id)); 

 CREATE TABLE probabilidade_exposicao( 
      id number(10)    NOT NULL , 
      pontuacao binary_double  (5,2)    NOT NULL , 
      probabilidade_exposicao varchar  (45)    NOT NULL , 
 PRIMARY KEY (id)); 

 CREATE TABLE probabilidade_exposicao_detalhe( 
      id number(10)    NOT NULL , 
      probabilidade_exposicao_detalhe varchar  (200)    NOT NULL , 
      probabilidade_exposicao_id number(10)    NOT NULL , 
 PRIMARY KEY (id)); 

 CREATE TABLE probabilidade_perda( 
      id number(10)    NOT NULL , 
      pontuacao binary_double  (5,2)    NOT NULL , 
      probabilidade_perda varchar  (100)    NOT NULL , 
 PRIMARY KEY (id)); 

 CREATE TABLE risco( 
      id number(10)    NOT NULL , 
      tipo_perigo_id number(10)    NOT NULL , 
      risco varchar  (200)    NOT NULL , 
 PRIMARY KEY (id)); 

 CREATE TABLE s_ferimento( 
      id number(10)    NOT NULL , 
      classificacao char  (2)    NOT NULL , 
      severidade varchar  (100)    NOT NULL , 
 PRIMARY KEY (id)); 

 CREATE TABLE sistema_seguranca( 
      id number(10)    NOT NULL , 
      sistema_seguranca varchar  (100)    NOT NULL , 
 PRIMARY KEY (id)); 

 CREATE TABLE sistema_seguranca_tipo( 
      id number(10)    NOT NULL , 
      sistema_seguranca_id number(10)    NOT NULL , 
      descricao_tipo varchar  (200)    NOT NULL , 
      hint CLOB   , 
 PRIMARY KEY (id)); 

 CREATE TABLE status_item( 
      id number(10)    NOT NULL , 
      status_item varchar  (45)    NOT NULL , 
 PRIMARY KEY (id)); 

 CREATE TABLE tipo_perigo( 
      id number(10)    NOT NULL , 
      tipo_perigo varchar  (100)    NOT NULL , 
 PRIMARY KEY (id)); 

 CREATE TABLE titulo_parecer_tecnico( 
      id number(10)    NOT NULL , 
      titulo_parecer_tecnico varchar  (100)    NOT NULL , 
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
 CREATE SEQUENCE apreciacao_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER apreciacao_id_seq_tr 

BEFORE INSERT ON apreciacao FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT apreciacao_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE cidade_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER cidade_id_seq_tr 

BEFORE INSERT ON cidade FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT cidade_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE classificacao_risco_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER classificacao_risco_id_seq_tr 

BEFORE INSERT ON classificacao_risco FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT classificacao_risco_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE empresa_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER empresa_id_seq_tr 

BEFORE INSERT ON empresa FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT empresa_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE empresa_unidade_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER empresa_unidade_id_seq_tr 

BEFORE INSERT ON empresa_unidade FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT empresa_unidade_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE equipamento_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER equipamento_id_seq_tr 

BEFORE INSERT ON equipamento FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT equipamento_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE estado_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER estado_id_seq_tr 

BEFORE INSERT ON estado FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT estado_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE f_exposicao_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER f_exposicao_id_seq_tr 

BEFORE INSERT ON f_exposicao FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT f_exposicao_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE frequencia_exposicao_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER frequencia_exposicao_id_seq_tr 

BEFORE INSERT ON frequencia_exposicao FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT frequencia_exposicao_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE hrn_fe_id__seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER hrn_fe_id__seq_tr 

BEFORE INSERT ON hrn_fe FOR EACH ROW 

WHEN 

(NEW.id_ IS NULL) 

BEGIN 

SELECT hrn_fe_id__seq.NEXTVAL INTO :NEW.id_ FROM DUAL; 

END;
CREATE SEQUENCE hrn_np_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER hrn_np_id_seq_tr 

BEFORE INSERT ON hrn_np FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT hrn_np_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE hrn_pe_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER hrn_pe_id_seq_tr 

BEFORE INSERT ON hrn_pe FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT hrn_pe_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE hrn_pmp_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER hrn_pmp_id_seq_tr 

BEFORE INSERT ON hrn_pmp FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT hrn_pmp_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE item_norma_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER item_norma_id_seq_tr 

BEFORE INSERT ON item_norma FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT item_norma_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE levantamento_risco_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER levantamento_risco_id_seq_tr 

BEFORE INSERT ON levantamento_risco FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT levantamento_risco_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE medida_seguranca_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER medida_seguranca_id_seq_tr 

BEFORE INSERT ON medida_seguranca FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT medida_seguranca_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE pais_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER pais_id_seq_tr 

BEFORE INSERT ON pais FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT pais_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE parecer_tecnico_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER parecer_tecnico_id_seq_tr 

BEFORE INSERT ON parecer_tecnico FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT parecer_tecnico_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE perigo_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER perigo_id_seq_tr 

BEFORE INSERT ON perigo FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT perigo_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE pessoas_expostas_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER pessoas_expostas_id_seq_tr 

BEFORE INSERT ON pessoas_expostas FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT pessoas_expostas_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE p_evitar_perigo_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER p_evitar_perigo_id_seq_tr 

BEFORE INSERT ON p_evitar_perigo FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT p_evitar_perigo_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE ponto_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER ponto_id_seq_tr 

BEFORE INSERT ON ponto FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT ponto_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE ponto_parecer_tecnico_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER ponto_parecer_tecnico_id_seq_tr 

BEFORE INSERT ON ponto_parecer_tecnico FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT ponto_parecer_tecnico_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE ponto_perigo_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER ponto_perigo_id_seq_tr 

BEFORE INSERT ON ponto_perigo FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT ponto_perigo_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE ponto_risco_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER ponto_risco_id_seq_tr 

BEFORE INSERT ON ponto_risco FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT ponto_risco_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE ponto_sistema_seguranca_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER ponto_sistema_seguranca_id_seq_tr 

BEFORE INSERT ON ponto_sistema_seguranca FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT ponto_sistema_seguranca_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE probabilidade_exposicao_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER probabilidade_exposicao_id_seq_tr 

BEFORE INSERT ON probabilidade_exposicao FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT probabilidade_exposicao_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE probabilidade_exposicao_detalhe_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER probabilidade_exposicao_detalhe_id_seq_tr 

BEFORE INSERT ON probabilidade_exposicao_detalhe FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT probabilidade_exposicao_detalhe_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE probabilidade_perda_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER probabilidade_perda_id_seq_tr 

BEFORE INSERT ON probabilidade_perda FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT probabilidade_perda_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE risco_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER risco_id_seq_tr 

BEFORE INSERT ON risco FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT risco_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE s_ferimento_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER s_ferimento_id_seq_tr 

BEFORE INSERT ON s_ferimento FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT s_ferimento_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE sistema_seguranca_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER sistema_seguranca_id_seq_tr 

BEFORE INSERT ON sistema_seguranca FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT sistema_seguranca_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE sistema_seguranca_tipo_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER sistema_seguranca_tipo_id_seq_tr 

BEFORE INSERT ON sistema_seguranca_tipo FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT sistema_seguranca_tipo_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE status_item_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER status_item_id_seq_tr 

BEFORE INSERT ON status_item FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT status_item_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE tipo_perigo_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER tipo_perigo_id_seq_tr 

BEFORE INSERT ON tipo_perigo FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT tipo_perigo_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE titulo_parecer_tecnico_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER titulo_parecer_tecnico_id_seq_tr 

BEFORE INSERT ON titulo_parecer_tecnico FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT titulo_parecer_tecnico_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
  
 commit;