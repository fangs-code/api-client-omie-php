<?php
namespace Fangs\ApiClients\Omie\v1\Models\Geral\Produtos;

/**
 * Class ProdutoEntityOmieModel.
 *
 * @author  Leonardo de Aguiar <leoaguiarpereira@gmail.com>
 * @package Fangs\ApiClients\Omie\v1\Models\Geral\Produtos
 * @name    ProdutoEntityOmieModel
 * @version 1.0.0
 */
class ProdutoEntityOmieModel
{
    /**
     * Código interno do omie, mapeado através do campo [codigo_produto].
     * Recomenda-se armazenar como BIGINT.
     */
    protected ?int $idOmie = null;

    /**
     * Código interno de integração do omie, mapeado através do campo [codigo_produto_integracao].
     * Recomenda-se armazenar como VARCHAR(20).
     */
    protected ?string $idIntegracao = null;

    /**
     * Descrição do produto.
     * Recomenda-se armazenar como VARCHAR(120).
     */
    protected ?string $descricao = null;

    /**
     * Descrição detalhada do produto.
     * Recomenda-se armazenar como TEXT.
     */
    protected ?string $descricaoDetalhada = null;

    /**
     * Indica se a Descrição Detalhada deve ser exibida nas Informações Adicionais do Item da NF-e (S/N).
     * Recomenda-se armazenar como VARCHAR(1).
     */
    protected ?string $exibirDescricaoNfe = null;

    /**
     * Indica se a Descrição Detalhada deve ser exibida na impressão do Pedido (S/N).
     * Recomenda-se armazenar como VARCHAR(1).
     */
    protected ?string $exibirDescricaoPedido = null;

    /**
     * Observações Internas.
     * Recomenda-se armazenar como TEXT.
     */
    protected ?string $observacoesInternas = null;

    /**
     * Código do produto exibido na tela de produtos do omie.
     * Recomenda-se armazenar como VARCHAR(60).
     */
    protected ?string $codigo = null;

    /**
     * Código da unidade.
     * Recomenda-se armazenar como VARCHAR(6).
     * Preenchimento Obrigatório.
     */
    protected ?string $unidade = null;

    /**
     * Código da Nomenclatura Comum do Mercosul (NCM).
     * Recomenda-se armazenar como VARCHAR(13).
     * Preenchimento Obrigatório.
     */
    protected ?string $ncm = null;

    /**
     * Código EAN (GTIN - Global Trade Item Number).
     * Recomenda-se armazenar como VARCHAR(14).
     */
    protected ?string $ean = null;

    /**
     * Valor Unitário do produto.
     * Recomenda-se armazenar como DECIMAL(15,4).
     */
    protected ?float $valorUnitario = null;

    /**
     * Código da Familia do Produto.
     * Recomenda-se armazenar como BIGINT.
     */
    protected ?int $codigoFamilia = null;

    /**
     * Código de Integração da Familia do Produto.
     * Recomenda-se armazenar como VARCHAR(20).
     */
    protected ?string $codigoIntegracaoFamilia = null;

    /**
     * Descrição da Familia do Produto.
     * Recomenda-se armazenar como VARCHAR(50).
     */
    protected ?string $descricaoFamilia = null;

    /**
     * Código do Tipo do Item para o SPED. Pode ser:
     * 00 - Mercadoria para Revenda
     * 01 - Matéria Prima
     * 02 - Embalagem
     * 03 - Produto em Processo
     * 04 - Produto Acabado
     * 05 - Subproduto
     * 06 - Produto Intermediário
     * 07 - Material de Uso e Consumo
     * 08 - Ativo Imobilizado
     * 09 - Serviços
     * 10 - Outros Insumos
     * 99 - Outras
     * Recomenda-se armazenar como VARCHAR(2).
     */
    protected ?string $tipoItem = null;

    /**
     * Peso Bruto (Kg).
     * Recomenda-se armazenar como DECIMAL(15,4).
     */
    protected ?float $pesoBruto = null;

    /**
     * Peso Líquido (Kg).
     * Recomenda-se armazenar como DECIMAL(15,4).
     */
    protected ?float $pesoLiquido = null;

    /**
     * Altura (centímetros).
     * Recomenda-se armazenar como DECIMAL(15,4).
     */
    protected ?float $altura = null;

    /**
     * Largura (centímetros).
     * Recomenda-se armazenar como DECIMAL(15,4).
     */
    protected ?float $largura = null;

    /**
     * Profundidade (centímetros).
     * Recomenda-se armazenar como DECIMAL(15,4).
     */
    protected ?float $profundidade = null;

    /**
     * Marca.
     * Recomenda-se armazenar como VARCHAR(60).
     */
    protected ?string $marca = null;

    /**
     * Dias de Garantia.
     * Recomenda-se armazenar como INT.
     */
    protected ?int $diasGarantia = null;

    /**
     * Dias de Crossdocking.
     * Recomenda-se armazenar como INT.
     */
    protected ?int $diasCrossdocking = null;

    /**
     * Código da Situação Tributária do ICMS.
     * Recomenda-se armazenar como VARCHAR(2).
     */
    protected ?string $cstIcms = null;

    /**
     * Modalidade da Base de Cálculo do ICMS.
     * Recomenda-se armazenar como VARCHAR(1).
     */
    protected ?string $modalidadeIcms = null;

    /**
     * Código da Situação Tributária para Simples Nacional.
     * Recomenda-se armazenar como VARCHAR(3).
     */
    protected ?string $csosnIcms = null;

    /**
     * Alíquota de ICMS.
     * Recomenda-se armazenar como DECIMAL(15,4).
     */
    protected ?float $aliquotaIcms = null;

    /**
     * Percentual de redução de base do ICMS.
     * Recomenda-se armazenar como DECIMAL(15,4).
     */
    protected ?float $reducaoBaseIcms = null;

    /**
     * Motivo da desoneração do ICMS.
     * Recomenda-se armazenar como VARCHAR(2).
     */
    protected ?string $motivoDesoneracaoIcms = null;

    /**
     * Percentual do Fundo de Combate a Pobreza do ICMS.
     * Recomenda-se armazenar como DECIMAL(15,4).
     */
    protected ?float $percentualFcpIcms = null;

    /**
     * Código de integração da característica do produto.
     * Recomenda-se armazenar como VARCHAR(20).
     */
    protected ?string $codigoBeneficio = null;

    /**
     * Código da Situação Tributária do PIS.
     * Recomenda-se armazenar como VARCHAR(2).
     */
    protected ?string $cstPis = null;

    /**
     * Alíquota do PIS.
     * Recomenda-se armazenar como DECIMAL(15,4).
     */
    protected ?float $aliquotaPis = null;

    /**
     * Código da Situação Tributária do COFINS.
     * Recomenda-se armazenar como VARCHAR(2).
     */
    protected ?string $cstCofins = null;

    /**
     * Alíquota do COFINS.
     * Recomenda-se armazenar como DECIMAL(15,4).
     */
    protected ?float $aliquotaCofins = null;

    /**
     * CFOP do Produto.
     * Recomenda-se armazenar como VARCHAR(10).
     */
    protected ?string $cfop = null;

    /**
     * Indica se o registro está bloqueado (S/N).
     * Recomenda-se armazenar como VARCHAR(1).
     */
    protected ?string $bloqueado = null;

    /**
     * Indica se o registro está bloqueado para exclusão (S/N).
     * Recomenda-se armazenar como VARCHAR(1).
     */
    protected ?string $bloquearExclusao = null;

    /**
     * Indica se o registro foi incluído via API (S/N).
     * Recomenda-se armazenar como VARCHAR(1).
     */
    protected ?string $importadoApi = null;

    /**
     * Indica se o cadastro do produto está inativo (S/N).
     * Recomenda-se armazenar como VARCHAR(1).
     */
    protected ?string $inativo = null;
}
