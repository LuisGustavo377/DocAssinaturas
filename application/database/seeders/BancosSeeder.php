<?php
        
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BancosSeeder extends Seeder
{
    /**
     * Run the seeder.
     *
     * @return void
     */
    public function run()
    {
        $bancos = [
            ['id' => Str::uuid(), 'codigo' => '1', 'nome' => 'Banco do Brasil S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '3', 'nome' => 'Banco da Amazônia S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '4', 'nome' => 'Banco do Nordeste do Brasil S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '7', 'nome' => 'Banco Nacional de Desenvolvimento Econômico e Social – BNDES', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '12', 'nome' => 'Banco Inbursa S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '25', 'nome' => 'Banco Alfa S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '29', 'nome' => 'Banco Itaú Consignado S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '31', 'nome' => 'Código Banco Beg S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '33', 'nome' => 'Banco SANTANDER', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '37', 'nome' => 'Banco do Estado do Pará S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '40', 'nome' => 'Banco Cargill S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '41', 'nome' => 'Banco do Estado do Rio Grande do Sul S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '47', 'nome' => 'Banco do Estado de Sergipe S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '51', 'nome' => 'Banco de Desenvolvimento do Espírito Santo S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '63', 'nome' => 'Banco Bradescard S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '65', 'nome' => 'Banco Andbank (Brasil) S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '66', 'nome' => 'Banco Morgan Stanley S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '69', 'nome' => 'Banco Crefisa S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '75', 'nome' => 'Banco ABN AMRO S.A', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '76', 'nome' => 'Banco KDB S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '77', 'nome' => 'Banco Inter S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '80', 'nome' => 'B&T Cc Ltda', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '83', 'nome' => 'Banco da China Brasil S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '94', 'nome' => 'Banco Finaxis S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '96', 'nome' => 'Banco B3 S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '104', 'nome' => 'Banco Caixa Econômica Federal', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '107', 'nome' => 'Banco BOCOM BBM S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '117', 'nome' => 'Advanced Cc Ltda', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '121', 'nome' => 'Banco Agibank S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '122', 'nome' => 'Banco Bradesco BERJ S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '172', 'nome' => 'Albatross Ccv S.A', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '184', 'nome' => 'Banco Itaú BBA S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '188', 'nome' => 'Ativa Investimentos S.A', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '196', 'nome' => 'Banco Fair Corretora de Câmbio S.A', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '197', 'nome' => 'Stone Pagamentos', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '204', 'nome' => 'Banco Bradesco Cartões S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '208', 'nome' => 'Banco BTG Pactual S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '212', 'nome' => 'Banco Original', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '213', 'nome' => 'Banco Arbi S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '217', 'nome' => 'Banco John Deere S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '218', 'nome' => 'Banco BS2 S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '222', 'nome' => 'Banco Credit Agricole Brasil S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '224', 'nome' => 'Banco Fibra S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '233', 'nome' => 'Banco Cifra S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '237', 'nome' => 'Banco Bradesco S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '241', 'nome' => 'Banco Clássico S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '243', 'nome' => 'Banco Máxima S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '246', 'nome' => 'Banco ABC Brasil S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '249', 'nome' => 'Banco Investcred Unibanco S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '260', 'nome' => 'Nubank', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '265', 'nome' => 'Banco Fator S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '266', 'nome' => 'Banco Cédula S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '290', 'nome' => 'PagBank', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '300', 'nome' => 'Banco de La Nacion Argentina', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '318', 'nome' => 'Banco BMG S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '323', 'nome' => 'Mercado Pago', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '335', 'nome' => 'Banco Digio S.A', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '336', 'nome' => 'Banco C6 S.A – C6 Bank', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '340', 'nome' => 'Superdigital', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '341', 'nome' => 'Banco Itaú', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '368', 'nome' => 'Banco Carrefour', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '370', 'nome' => 'Banco Mizuho do Brasil S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '376', 'nome' => 'Banco J. P. Morgan S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '380', 'nome' => 'PicPay', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '389', 'nome' => 'Banco Mercantil do Brasil S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '394', 'nome' => 'Banco Bradesco Financiamentos S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '412', 'nome' => 'Banco Capital S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '422', 'nome' => 'Banco Safra', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '456', 'nome' => 'Banco MUFG Brasil S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '473', 'nome' => 'Banco Caixa Geral – Brasil S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '479', 'nome' => 'Banco ItauBank S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '494', 'nome' => 'Banco de La Republica Oriental del Uruguay', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '495', 'nome' => 'Banco de La Provincia de Buenos Aires', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '505', 'nome' => 'Banco Credit Suisse (Brasil) S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '600', 'nome' => 'Banco Luso Brasileiro S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '604', 'nome' => 'Banco Industrial do Brasil S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '612', 'nome' => 'Banco Guanabara S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '626', 'nome' => 'Banco Ficsa S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '641', 'nome' => 'Banco Alvorada S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '653', 'nome' => 'Banco Indusval S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '654', 'nome' => 'Banco A.J.Renner S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '707', 'nome' => 'Banco Daycoval S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '720', 'nome' => 'Banco Maxinvest S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '735', 'nome' => 'Neon Pagamentos', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '739', 'nome' => 'Banco Cetelem S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '745', 'nome' => 'Banco Citibank S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '746', 'nome' => 'Banco Modal S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '748', 'nome' => 'Banco Cooperativo Sicredi S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '752', 'nome' => 'Banco BNP Paribas Brasil S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '756', 'nome' => 'Banco Cooperativo do Brasil S.A. – BANCOOB', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'codigo' => '757', 'nome' => 'Banco KEB HANA do Brasil S.A.', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('bancos')->insert($bancos);
    }
}