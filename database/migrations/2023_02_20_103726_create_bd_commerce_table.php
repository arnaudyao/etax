<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_has_permissions', function (Blueprint $table) {
            $table->bigInteger('permission_id');
            $table->bigInteger('role_id');

            $table->primary(['permission_id', 'role_id']);
        });

        Schema::create('reglement', function (Blueprint $table) {
            $table->increments('num_reg');
            $table->decimal('num_fact', 10, 0);
            $table->integer('num_mpaie');
            $table->decimal('montant_ttc_reg', 10, 0)->nullable()->default(0);
            $table->timestamps();
            $table->decimal('num_agce', 10, 0)->nullable();
            $table->decimal('montant_donnee_ttc_reg', 10, 0)->nullable()->default(0);
            $table->decimal('monnaie_ttc_reg', 10, 0)->nullable()->default(0);
        });

        Schema::create('tauxtva', function (Blueprint $table) {
            $table->integer('val_taxe')->nullable();
        });

        Schema::create('taxe', function (Blueprint $table) {
            $table->integer('code_taxe')->primary();
            $table->integer('val_taxe')->nullable();
            $table->string('lib_taxe', 100)->nullable();
            $table->string('const_taxe', 3)->nullable();
            $table->boolean('flag_taxe')->nullable()->default(true);
            $table->timestamps();
        });

        Schema::create('tbl_form_whatsapp', function (Blueprint $table) {
            $table->bigIncrements('num_clt');
            $table->string('nom');
            $table->string('prenom');
            $table->string('vin');
            $table->string('typeclient');
            $table->string('numero');
            $table->string('parution');
            $table->string('modele');
            $table->string('souscription')->nullable();
            $table->string('nomentreprise')->nullable();
            $table->string('interlocuteur')->nullable();
            $table->timestamps();
        });

        Schema::create('tbl_modele', function (Blueprint $table) {
            $table->bigIncrements('num_mod');
            $table->string('libelle');
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->nullable()->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->string('genre_users', 10)->nullable();
            $table->string('cel_users')->nullable();
            $table->string('tel_users')->nullable();
            $table->string('localisation_users')->nullable();
            $table->string('adresse_users')->nullable();
            $table->string('prenom_users')->nullable();
            $table->bigInteger('id_partenaire')->nullable();
            $table->boolean('flag_mdp')->nullable();
            $table->text('photo_profil')->nullable();
            $table->bigInteger('indicatif_tel_users')->nullable();
            $table->bigInteger('indicatif_cel_users')->nullable();
            $table->boolean('flag_actif_users')->nullable()->default(true);
            $table->boolean('flag_demission_users')->nullable()->default(false);
            $table->boolean('flag_admin_users')->nullable()->default(false);
            $table->decimal('num_agce', 10, 0)->nullable();
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('guard_name');
            $table->timestamps();
            $table->string('code_roles', 120)->nullable();
        });

        Schema::create('type_client', function (Blueprint $table) {
            $table->increments('num_typecli');
            $table->string('lib_typecli', 100)->nullable();
            $table->boolean('flag_typecli')->nullable()->default(true);
            $table->timestamps();
        });

        Schema::create('sous_famille', function (Blueprint $table) {
            $table->decimal('num_sousfam', 10, 0);
            $table->decimal('num_fam', 10, 0)->index('i_fk_sous_famille_famille');
            $table->string('lib_sousfam', 150)->nullable();
            $table->boolean('flag_sousfam')->nullable()->default(true);
            $table->timestamps();
        });

        Schema::create('role_has_sousmenus', function (Blueprint $table) {
            $table->bigInteger('sousmenus_id_sousmenu');
            $table->bigInteger('role_id');

            $table->primary(['sousmenus_id_sousmenu', 'role_id']);
        });

        Schema::create('sousmenu', function (Blueprint $table) {
            $table->bigIncrements('id_sousmenu');
            $table->integer('menu_id_menu');
            $table->string('sousmenu')->nullable();
            $table->timestamps();
            $table->string('libelle')->nullable();
            $table->decimal('priorite_sousmenu', 10, 0)->nullable();
        });

        Schema::create('type_mvt_fond_caisse', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('type_mvt_fd', 120)->nullable();
            $table->boolean('flag_type_mvt_fd')->nullable()->default(true);
            $table->string('sens', 12)->nullable();
        });

        Schema::create('bon_livraison', function (Blueprint $table) {
            $table->decimal('num_bl', 10, 0)->primary();
            $table->decimal('num_comc', 10, 0)->nullable()->index('i_fk_bon_livraison_commandecli');
            $table->decimal('num_fact', 10, 0)->nullable()->index('i_fk_bon_livraison_facture');
            $table->timestamp('date_cre_bl')->nullable()->useCurrent();
            $table->timestamp('date_val_bl')->nullable();
            $table->boolean('flag_tva_bl')->nullable()->default(false);
            $table->decimal('mont_bl', 10, 0)->nullable()->default(0);
            $table->boolean('flag_bl')->nullable()->default(false);
            $table->boolean('solde_bl')->nullable()->default(false);
            $table->boolean('annule_bl')->nullable()->default(false);
            $table->decimal('num_cli', 10, 0)->nullable();
            $table->decimal('id_user', 10, 0)->nullable();
            $table->decimal('num_agce', 10, 0)->nullable();
            $table->decimal('prix_ttc_bl', 10, 0)->nullable()->default(0);
            $table->decimal('prix_ht_bl', 10, 0)->nullable()->default(0);
            $table->decimal('prix_tva_bl', 10, 0)->nullable()->default(0);
            $table->timestamps();
        });

        Schema::create('facture', function (Blueprint $table) {
            $table->decimal('num_bl', 10, 0);
            $table->decimal('num_fact', 10, 0)->primary();
            $table->string('code_fact', 50)->nullable();
            $table->timestamp('date_cre_fact')->nullable()->useCurrent();
            $table->timestamp('date_val_fact')->nullable();
            $table->boolean('flag_tva_fact')->nullable()->default(false);
            $table->decimal('mont_fact', 10, 0)->nullable()->default(0);
            $table->boolean('flag_fact')->nullable()->default(false);
            $table->boolean('solde_fact')->nullable()->default(false);
            $table->boolean('annule_fact')->nullable()->default(false);
            $table->decimal('num_cli', 10, 0)->nullable();
            $table->decimal('id_user', 10, 0)->nullable();
            $table->decimal('num_agce', 10, 0)->nullable();
            $table->decimal('prix_ttc_fact', 10, 0)->nullable()->default(0);
            $table->decimal('prix_ht_fact', 10, 0)->nullable()->default(0);
            $table->decimal('prix_tva_fact', 10, 0)->nullable()->default(0);
            $table->timestamps();
        });

        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('connection');
            $table->text('queue');
            $table->text('payload');
            $table->text('exception');
            $table->timestamp('failed_at')->useCurrent();
        });

        Schema::create('commandeclient', function (Blueprint $table) {
            $table->decimal('num_comc', 10, 0);
            $table->decimal('num_cli', 10, 0)->index('i_fk_commandeclient_client');
            $table->string('code_comc', 20);
            $table->timestamp('date_cre_comc')->nullable()->useCurrent();
            $table->timestamp('date_val_comc')->nullable();
            $table->decimal('mont_comc', 10, 0)->nullable()->default(0);
            $table->boolean('flag_tva_comc')->nullable()->default(false);
            $table->boolean('flag_comc')->nullable()->default(false);
            $table->boolean('solde_comc')->nullable()->default(false);
            $table->boolean('annule_comc')->nullable()->default(false);
            $table->decimal('id_user', 10, 0)->nullable();
            $table->decimal('num_agce', 10, 0)->nullable();
            $table->text('comment_comc')->nullable();
            $table->boolean('flag_bl_comc')->nullable()->default(false);
            $table->decimal('tot_ttc_lcomc', 10, 0)->nullable()->default(0);
            $table->decimal('tot_ht_lcomc', 10, 0)->nullable()->default(0);
            $table->decimal('tot_tva_lcomc', 10, 0)->nullable()->default(0);
            $table->decimal('prix_ttc_comc', 10, 0)->nullable()->default(0);
            $table->decimal('prix_ht_comc', 10, 0)->nullable()->default(0);
            $table->decimal('prix_tva_comc', 10, 0)->nullable()->default(0);
            $table->boolean('flag_bl')->nullable()->default(false);
            $table->timestamps();
            $table->decimal('num_bon_commande', 10, 0)->nullable();
            $table->text('fichier_proformat')->nullable();
            $table->boolean('flag_devis')->nullable()->default(false);
            $table->boolean('flag_devis_comc')->nullable()->default(false);
            $table->text('fichier_devis')->nullable();
        });

        Schema::create('commandefour', function (Blueprint $table) {
            $table->decimal('num_comf', 10, 0);
            $table->decimal('num_agce', 10, 0)->index('i_fk_commandefour_agence');
            $table->decimal('num_fourn', 10, 0)->index('i_fk_commandefour_fournisseur');
            $table->timestamp('date_val_comf')->nullable();
            $table->integer('flag_tva_comf')->nullable()->default(0);
            $table->decimal('mont_comf', 10, 0)->nullable()->default(0);
            $table->boolean('flag_comf')->nullable()->default(false);
            $table->boolean('solde_comf')->nullable()->default(false);
            $table->boolean('annule_comf')->nullable()->default(false);
            $table->decimal('id_user', 10, 0)->nullable();
            $table->decimal('prix_ht_comf', 10, 0)->nullable()->default(0);
            $table->decimal('prix_ttc_comf', 10, 0)->nullable()->default(0);
            $table->boolean('flag_comf_br')->nullable()->default(true);
            $table->text('comment_com')->nullable();
            $table->timestamps();
        });

        Schema::create('ligne_bl', function (Blueprint $table) {
            $table->decimal('num_bl', 10, 0)->index('i_fk_ligne_bl_bon_livraison');
            $table->decimal('num_prod', 10, 0)->nullable()->index('i_fk_ligne_bl_produit');
            $table->decimal('num_lbl', 10, 0)->primary();
            $table->decimal('qte_lbl', 10, 0)->nullable();
            $table->decimal('prix_ttc_lbl', 10, 0)->nullable();
            $table->decimal('prix_ht_lbl', 10, 0)->nullable();
            $table->decimal('prix_tva_lbl', 10, 0)->nullable();
            $table->boolean('flag_tva_lbl')->nullable()->default(false);
            $table->decimal('tot_ttc_lbl', 10, 0)->nullable()->default(0);
            $table->decimal('tot_ht_lbl', 10, 0)->nullable()->default(0);
            $table->decimal('tot_tva_lbl', 10, 0)->nullable()->default(0);
            $table->timestamps();
            $table->decimal('num_lcomc', 10, 0)->nullable();
            $table->decimal('remise_lbl', 10, 0)->nullable();
            $table->decimal('remise_ttc_lbl', 10, 0)->nullable()->default(0);
            $table->smallInteger('flag_stock_ln')->nullable()->default(0);
        });

        Schema::create('ligne_br', function (Blueprint $table) {
            $table->decimal('num_br', 10, 0)->index('i_fk_ligne_br_reception_four');
            $table->decimal('num_prod', 10, 0)->index('i_fk_ligne_br_produit');
            $table->decimal('num_lbr', 10, 0)->nullable();
            $table->decimal('qte_lbr', 10, 0)->nullable();
            $table->decimal('prix_ttc_lbr', 10, 0)->nullable()->default(0);
            $table->decimal('prix_ht_lbr', 10, 0)->nullable()->default(0);
            $table->decimal('prix_tva_lbr', 10, 0)->nullable()->default(0);
            $table->decimal('prix_net_lbr', 10, 0)->nullable()->default(0);
            $table->boolean('flag_tva_lbr')->nullable()->default(false);
            $table->integer('taux_tva_lbr')->nullable()->default(0);
            $table->decimal('remise_lbr', 10, 0)->default(0);
            $table->decimal('tot_ttc_lbr', 10, 0)->nullable()->default(0);
            $table->decimal('tot_ht_lbr', 10, 0)->nullable()->default(0);
            $table->decimal('tot_tva_lbr', 10, 0)->nullable()->default(0);
            $table->smallInteger('flag_stock_ln')->default(0);
            $table->decimal('frais_app_lbr', 10, 0)->default(0);
            $table->decimal('revient_lbr', 10, 0)->default(0);
            $table->decimal('mt_remise_lbr', 10, 0)->default(0);
            $table->decimal('num_lcomfour', 10, 0)->nullable();
            $table->smallInteger('flag_stck_tpep')->nullable()->default(0);
            $table->decimal('qte_rest_lbr', 10, 0)->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('created_at')->nullable();

            $table->primary(['num_br', 'num_prod']);
        });

        Schema::create('ligne_fact', function (Blueprint $table) {
            $table->decimal('num_fact', 10, 0);
            $table->decimal('num_prod', 10, 0)->nullable();
            $table->decimal('num_lfact', 10, 0)->primary();
            $table->decimal('qte_lfact', 10, 0)->nullable();
            $table->decimal('prix_ttc_lfact', 10, 0)->nullable();
            $table->decimal('prix_ht_lfact', 10, 0)->nullable();
            $table->decimal('prix_tva_lfact', 10, 0)->nullable();
            $table->boolean('flag_tva_lfact')->nullable()->default(false);
            $table->decimal('tot_ttc_lfact', 10, 0)->nullable()->default(0);
            $table->decimal('tot_ht_lfact', 10, 0)->nullable()->default(0);
            $table->decimal('tot_tva_lfact', 10, 0)->nullable()->default(0);
            $table->timestamps();
            $table->decimal('num_lbl', 10, 0)->nullable();
            $table->decimal('remise_lfact', 10, 0)->nullable();
            $table->decimal('remise_ttc_lfact', 10, 0)->nullable()->default(0);
            $table->smallInteger('flag_stock_ln')->nullable();
        });

        Schema::create('fournisseur', function (Blueprint $table) {
            $table->decimal('num_fourn', 10, 0);
            $table->string('lib_fourn')->nullable();
            $table->string('adr_fourn', 128)->nullable();
            $table->string('tel_fourn', 65)->nullable();
            $table->string('cel_fourn', 65)->nullable();
            $table->string('fax_fourn', 65)->nullable();
            $table->string('mail_fourn', 100)->nullable();
            $table->string('rccm_fourn', 75)->nullable();
            $table->string('cpte_contr_fourn', 75)->nullable();
            $table->boolean('flag_tva_fourn')->nullable()->default(true);
            $table->boolean('flag_fourn')->nullable()->default(true);
            $table->timestamps();
        });

        Schema::create('famille', function (Blueprint $table) {
            $table->decimal('num_fam', 10, 0);
            $table->string('lib_fam', 175)->nullable();
            $table->boolean('flag_fam')->nullable()->default(true);
            $table->timestamps();
        });

        Schema::create('ligne_com', function (Blueprint $table) {
            $table->decimal('num_prod', 10, 0)->nullable()->index('i_fk_ligne_com_produit');
            $table->decimal('num_comc', 10, 0)->index('i_fk_ligne_com_commandeclient');
            $table->decimal('num_bl_lcomc', 10, 0);
            $table->decimal('qte_lcomc', 10, 0)->nullable()->default(0);
            $table->decimal('prix_ttc_lcomc', 10, 0)->nullable()->default(0);
            $table->decimal('prix_ht_lcomc', 10, 0)->nullable()->default(0);
            $table->decimal('prix_tva_lcomc', 10, 0)->nullable()->default(0);
            $table->boolean('flag_tva_lcomc')->nullable()->default(false);
            $table->decimal('tot_ttc_lcomc', 10, 0)->nullable()->default(0);
            $table->decimal('tot_ht_lcomc', 10, 0)->nullable()->default(0);
            $table->decimal('tot_tva_lcomc', 10, 0)->nullable()->default(0);
            $table->timestamps();
            $table->decimal('remise_lcomc', 10, 0)->nullable();
            $table->decimal('remise_ttc_lcomc', 10, 0)->nullable();
            $table->decimal('num_agce_vente', 10, 0)->nullable();
        });

        Schema::create('mode_paiement', function (Blueprint $table) {
            $table->integer('num_mpaie')->primary();
            $table->string('lib_mpaie', 100)->nullable();
            $table->boolean('flag_mpaie')->nullable()->default(true);
            $table->timestamps();
        });

        Schema::create('ligne_comfour', function (Blueprint $table) {
            $table->decimal('num_lcomfour', 10, 0);
            $table->decimal('num_prod', 10, 0)->index('i_fk_ligne_comfour_produit');
            $table->decimal('num_comf', 10, 0)->index('i_fk_ligne_comfour_commandefour');
            $table->decimal('qte_lcomfour', 10, 0)->nullable();
            $table->decimal('prix_ttc_lcomfour', 10, 0)->nullable();
            $table->decimal('prix_ht_lcomfour', 10, 0)->nullable();
            $table->decimal('prix_tva_lcomfour', 10, 0)->nullable();
            $table->decimal('prix_net_lcomfour', 10, 0)->nullable();
            $table->boolean('flag_tva_lcomfour')->nullable()->default(true);
            $table->decimal('remise_lcomfour', 10, 0)->nullable()->default(0);
            $table->decimal('tot_ttc_lcomfour', 10, 0)->nullable()->default(0);
            $table->decimal('tot_ht_lcomfour', 10, 0)->nullable()->default(0);
            $table->decimal('tot_tva_lcomfour', 10, 0)->nullable()->default(0);
            $table->decimal('mt_remise_lcomfour', 10, 0)->default(0);
            $table->decimal('taux_tva_lcomfour', 10, 0)->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('model_has_permissions', function (Blueprint $table) {
            $table->bigInteger('permission_id');
            $table->string('model_type');
            $table->bigInteger('model_id');

            $table->primary(['permission_id', 'model_id', 'model_type']);
            $table->index(['model_id', 'model_type']);
        });

        Schema::create('model_has_roles', function (Blueprint $table) {
            $table->bigInteger('role_id');
            $table->string('model_type');
            $table->bigInteger('model_id');

            $table->index(['model_id', 'model_type']);
            $table->primary(['role_id', 'model_id', 'model_type']);
        });

        Schema::create('menu', function (Blueprint $table) {
            $table->increments('id_menu');
            $table->string('menu');
            $table->timestamps();
            $table->decimal('priorite_menu', 10, 0)->nullable();
        });

        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('mvt_stock_prod', function (Blueprint $table) {
            $table->bigIncrements('id_mvstck');
            $table->timestamp('date_mvstck')->nullable();
            $table->string('type_mvstck', 15)->nullable();
            $table->bigInteger('num_prod')->default(0);
            $table->char('sens_mvstck', 2);
            $table->bigInteger('num_agce')->default(0);
            $table->bigInteger('num_agce_dest')->nullable();
            $table->bigInteger('num_agce_ag')->nullable();
            $table->string('num_agce_un', 5)->nullable();
            $table->string('num_agce_dest_un', 5)->nullable();
            $table->float('qte_mvstck', 0, 0)->default(0);
            $table->integer('num_fran')->nullable()->default(0);
            $table->bigInteger('id_user')->nullable()->default(0);
            $table->string('num_piece_mvt')->nullable();
            $table->string('lnnum_piece_mvt')->nullable();
            $table->integer('exo_mvt')->default(0);
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('reception_four', function (Blueprint $table) {
            $table->decimal('num_br', 10, 0)->primary();
            $table->decimal('num_comf', 10, 0)->index('i_fk_reception_four_commandefo');
            $table->timestamp('date_cre_br')->nullable()->useCurrent();
            $table->timestamp('date_val_br')->nullable();
            $table->integer('flag_tva_br')->nullable();
            $table->decimal('mont_br', 10, 0)->nullable();
            $table->boolean('flag_br')->nullable()->default(false);
            $table->boolean('solde_br')->nullable()->default(false);
            $table->boolean('annule_br')->nullable()->default(false);
            $table->decimal('id_user', 10, 0)->nullable()->default(0);
            $table->decimal('prix_ht_br', 10, 0)->nullable()->default(0);
            $table->decimal('prix_tva_br', 10, 0)->nullable()->default(0);
            $table->decimal('prix_ttc_br', 10, 0)->nullable()->default(0);
            $table->decimal('num_agce', 10, 0);
            $table->decimal('num_fourn', 10, 0);
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('guard_name');
            $table->timestamps();
        });

        Schema::create('rayon', function (Blueprint $table) {
            $table->string('code_ray_mig', 25)->nullable();
            $table->string('lib_ray', 200)->nullable()->index('indx_libray');
            $table->decimal('code_fa', 10, 0)->nullable();
            $table->integer('resp_ray')->nullable();
            $table->string('code_ray', 25);
            $table->integer('niveau_ray')->nullable();
            $table->bigIncrements('id_p_rayon');
            $table->timestamps();
        });

        Schema::create('sous_rayon', function (Blueprint $table) {
            $table->string('code_sr', 25);
            $table->string('lib_sr', 200)->nullable()->index('indx_libsr');
            $table->string('code_ray', 25)->index('i_fk_sous_rayon_rayon');
            $table->string('code_sra', 25)->nullable();
            $table->integer('niveau_sr')->nullable();
            $table->string('code_rgray', 25)->nullable();
            $table->string('code_ndp', 35)->nullable();
            $table->bigIncrements('id_p_sous_rayon');
            $table->timestamps();
        });

        Schema::create('logo', function (Blueprint $table) {
            $table->bigIncrements('id_logo');
            $table->string('titre_logo')->nullable();
            $table->text('logo_logo')->nullable();
            $table->boolean('flag_logo')->nullable()->default(false);
            $table->integer('id_user');
            $table->text('mot_cle')->nullable();
            $table->string('valeur')->nullable();
            $table->timestamps();
        });

        Schema::create('produit', function (Blueprint $table) {
            $table->decimal('num_prod', 10, 0);
            $table->decimal('num_sousfam', 10, 0)->nullable()->index('i_fk_produit_sous_famille');
            $table->string('code_prod', 20)->nullable()->default('produit_seq');
            $table->string('lib_prod');
            $table->decimal('prix_ht', 10, 0)->nullable();
            $table->decimal('prix_ttc', 10, 0)->nullable();
            $table->decimal('prix_achat_prod', 10, 0)->nullable();
            $table->decimal('prix_revient_prod', 10, 0)->nullable();
            $table->decimal('coef_vente_prod', 10, 0)->nullable();
            $table->integer('flag_tva_prod')->nullable()->default(1);
            $table->integer('taux_tva_prod')->nullable();
            $table->timestamps();
            $table->boolean('flag_prod')->nullable()->default(true);
            $table->decimal('code_barre_prod', 10, 0)->nullable();
            $table->decimal('taux_marque', 10, 0)->nullable();
            $table->text('image_prod')->nullable();
            $table->boolean('flag_prod_stock_is_valid')->nullable()->default(false);
        });

        Schema::create('client', function (Blueprint $table) {
            $table->decimal('num_cli', 10, 0);
            $table->decimal('num_agce', 10, 0)->nullable();
            $table->integer('num_typecli')->nullable();
            $table->string('code_cli', 15)->nullable();
            $table->string('nom_cli');
            $table->string('prenom_cli')->nullable();
            $table->string('local_cli')->nullable();
            $table->string('adresse_cli', 128)->nullable();
            $table->string('tel_cli', 65)->nullable();
            $table->string('mail_cli', 100)->nullable();
            $table->string('cel_cli', 65)->nullable();
            $table->string('rccm_cli', 75)->nullable();
            $table->string('cpte_contr_cli', 75)->nullable();
            $table->string('adresse_geo_cli')->nullable();
            $table->string('fax_cli', 65)->nullable();
            $table->boolean('flag_cli')->nullable()->default(true);
            $table->smallInteger('tva_cli')->nullable()->default(1);
            $table->timestamps();
            $table->decimal('taux_remise_cli', 10, 0)->nullable();
            $table->smallInteger('ristourne_cli')->nullable();
        });

        Schema::create('agence', function (Blueprint $table) {
            $table->decimal('num_agce', 10, 0);
            $table->string('lib_agce', 150);
            $table->boolean('flag_agce')->nullable()->default(true);
            $table->boolean('flag_siege_agce')->nullable()->default(false);
            $table->timestamps();
            $table->decimal('taux_ristourne_cli', 10, 0)->nullable();
            $table->string('contact_agce')->nullable();
            $table->string('email_agce')->nullable();
        });

        Schema::create('inventaire', function (Blueprint $table) {
            $table->decimal('num_inventaire', 10, 0);
            $table->string('code_inventaire', 175)->nullable();
            $table->date('date_inventaire')->nullable();
            $table->boolean('flag_inventaire')->nullable()->default(false);
            $table->boolean('flag_valid_inventaire')->nullable()->default(false);
            $table->boolean('flag_annule_inventaire')->nullable()->default(false);
            $table->timestamps();
            $table->decimal('id_user_c', 10, 0)->nullable();
            $table->decimal('num_agce', 10, 0)->nullable();
            $table->boolean('flag_valoriser_inv')->nullable()->default(false);
        });

        Schema::create('transactions', function (Blueprint $table) {
            $table->decimal('num_transactions', 10, 0);
            $table->string('transaction_id', 150);
            $table->string('mid', 150);
            $table->boolean('flag_transaction')->nullable()->default(true);
            $table->decimal('montant_donnee_ttc_reg', 10, 0)->nullable();
            $table->decimal('montant_ttc_reg', 10, 0)->nullable();
            $table->decimal('monnaie_ttc_reg', 10, 0)->nullable();
            $table->string('contact_agce')->nullable();
            $table->decimal('num_agce', 10, 0)->nullable();
            $table->decimal('num_fact', 10, 0)->nullable();
            $table->decimal('id_user', 10, 0)->nullable();
            $table->decimal('num_mpaie', 10, 0)->nullable();
            $table->timestamps();
            $table->boolean('flag_cloture')->nullable()->default(false);
            $table->decimal('tva_ttc', 10, 0)->nullable();
            $table->decimal('nombre_article', 10, 0)->nullable();
        });

        Schema::create('fond_caisse', function (Blueprint $table) {
            $table->increments('num_fond');
            $table->integer('montant_fond')->nullable();
            $table->date('date_fond')->nullable();
            $table->integer('num_caisse')->nullable();
            $table->boolean('flag_fond')->nullable()->default(false);
            $table->char('code_agce', 5)->nullable();
            $table->decimal('type_operation', 10, 0)->nullable();
            $table->boolean('flag_valid_caisse')->nullable()->default(false);
            $table->timestamps();
        });

        Schema::create('inventaire_stock_articles', function (Blueprint $table) {
            $table->decimal('num_inventaire_stock_article', 10, 0);
            $table->string('code_inventaire')->nullable();
            $table->string('num_prod')->nullable();
            $table->string('code_prod')->nullable();
            $table->string('code_barre_prod')->nullable();
            $table->string('lib_prod')->nullable();
            $table->string('lib_sousfam')->nullable();
            $table->string('lib_fam')->nullable();
            $table->string('quantie_theorique')->nullable();
            $table->boolean('flag_inventaire_stock_article_creer')->nullable()->default(true);
            $table->boolean('flag_inventaire_stock_article_ajout_prod_theo')->nullable()->default(false);
            $table->boolean('flag_valid_inventaire_stock_article')->nullable()->default(false);
            $table->boolean('flag_annule_inventaire_stock_article')->nullable()->default(false);
            $table->timestamps();
            $table->decimal('id_user_c', 10, 0)->nullable();
            $table->decimal('num_agce', 10, 0)->nullable();
            $table->string('quantie_physique')->nullable();
            $table->string('ecart_quantite')->nullable();
        });

        Schema::create('inventaireproduit', function (Blueprint $table) {
            $table->decimal('num_inventaireproduit', 10, 0);
            $table->string('code_inventaire', 175)->nullable();
            $table->string('produit_inventaire', 175)->nullable();
            $table->decimal('qte_inventaire', 10, 0)->nullable();
            $table->date('date_produit_inventaire')->nullable();
            $table->boolean('flag_produt_inventaire')->nullable()->default(true);
            $table->boolean('flag_valid_inventaire')->nullable()->default(false);
            $table->boolean('flag_annule_inventaire')->nullable()->default(false);
            $table->boolean('flag_supprime_inventaire')->nullable()->default(false);
            $table->decimal('id_user', 10, 0)->nullable();
            $table->timestamps();
        });

        Schema::create('cloture_caisse', function (Blueprint $table) {
            $table->increments('num_clot_caisse');
            $table->string('chiffrejournaliercaisse', 12)->nullable();
            $table->string('montantcloture', 12)->nullable();
            $table->date('date_fond')->nullable();
            $table->integer('num_caisse')->nullable();
            $table->boolean('flag_clot_caisse')->nullable()->default(false);
            $table->char('code_agce', 5)->nullable();
            $table->boolean('flag_valid_caisse')->nullable()->default(false);
            $table->timestamps();
        });

        Schema::create('avoir', function (Blueprint $table) {
            $table->bigIncrements('id_num_avoir');
            $table->string('num_avoir', 120);
            $table->bigInteger('num_transactions')->nullable()->index('ind_av_tra');
            $table->decimal('montant_tot', 10, 0)->nullable()->default(0);
            $table->timestamp('date_avoir')->nullable();
            $table->boolean('flag_avoir')->nullable()->default(false);
            $table->decimal('num_agce', 10, 0)->nullable();
            $table->string('code_agent', 15)->nullable();
            $table->string('nom_avoir', 100)->nullable();
            $table->string('adresse_avoir', 65)->nullable();
            $table->string('cc_avoir', 65)->nullable();
            $table->string('tel_avoir', 65)->nullable();
            $table->boolean('flag_av_util')->nullable()->default(false);
            $table->integer('num_caisse')->nullable();
            $table->boolean('flag_imp_av')->nullable()->default(false);
            $table->smallInteger('maj')->nullable()->default(0);
            $table->timestamps();
        });

        Schema::create('retour_art', function (Blueprint $table) {
            $table->bigIncrements('id_retour_art');
            $table->string('code_ra', 120);
            $table->bigInteger('id_num_avoir')->index('ind_av_retourart');
            $table->date('date_ret_art')->nullable()->useCurrent();
            $table->decimal('prix_achat', 10, 0)->nullable()->default(0);
            $table->bigInteger('code_lt')->nullable()->index('ind_ln_retourart');
            $table->bigInteger('quantite_ret_art')->nullable();
            $table->decimal('remise_ret_art', 10, 0)->nullable()->default(0);
            $table->string('code_art', 25)->nullable();
            $table->decimal('prix_achat_reel', 10, 0)->nullable()->default(0);
            $table->decimal('prix_achat_reel_ht', 10, 0)->nullable()->default(0);
            $table->decimal('prmp_ra', 10, 0)->nullable()->default(0);
            $table->boolean('flag_tva_ra')->nullable()->default(true);
            $table->boolean('flag_arsi_ra')->nullable()->default(false);
            $table->decimal('mt_tva_ra', 10, 0)->nullable()->default(0);
            $table->decimal('mt_arsi_ra', 10, 0)->nullable()->default(0);
            $table->decimal('taux_tva_ra', 10, 0)->nullable()->default(18);
            $table->decimal('taux_arsi_ra', 10, 0)->nullable()->default(0);
            $table->integer('vente_apisoft')->nullable();
            $table->boolean('flag_stock_ln')->nullable()->default(false);
            $table->boolean('flag_stock_ln_ann')->nullable()->default(false);
            $table->timestamps();
            $table->decimal('id_user', 10, 0)->nullable();
        });

        Schema::create('transfert', function (Blueprint $table) {
            $table->decimal('num_transf', 10, 0);
            $table->decimal('num_agce', 10, 0);
            $table->decimal('num_agce_dest', 10, 0);
            $table->decimal('id_user', 10, 0);
            $table->decimal('id_user_dest', 10, 0)->nullable();
            $table->timestamp('date_emiss_transf')->nullable();
            $table->timestamp('date_recept_transf')->nullable();
            $table->boolean('flag_emiss')->nullable()->default(false);
            $table->boolean('flag_recept')->nullable()->default(false);
            $table->timestamp('date_cre_transf')->nullable();
            $table->text('comment_transf')->nullable();
            $table->timestamps();
        });

        Schema::create('ligne_transfert', function (Blueprint $table) {
            $table->decimal('num_ltr', 10, 0);
            $table->decimal('num_transf', 10, 0);
            $table->decimal('num_prod', 10, 0);
            $table->decimal('qte_emiss_ltr', 10, 0);
            $table->decimal('qte_recept_ltr', 10, 0)->nullable();
            $table->timestamp('date_ltr')->nullable();
            $table->decimal('prix_ttc_ltr', 10, 0)->nullable()->default(0);
            $table->bigInteger('id_user')->nullable();
            $table->integer('flag_stock_ltr')->default(0);
            $table->integer('flag_stock_rc_ltr')->default(0);
            $table->timestamps();
        });

        DB::statement("CREATE VIEW \"vue_stock_prod\" AS  SELECT p.num_prod,
    0 AS qte_sortie,
    COALESCE(sum(mvt_stock_prod.qte_mvstck), ((0)::numeric)::double precision) AS qte_entree,
    p.lib_prod,
    p.code_prod,
    p.code_barre_prod
   FROM (mvt_stock_prod
     JOIN produit p ON ((p.num_prod = (mvt_stock_prod.num_prod)::numeric)))
  WHERE (mvt_stock_prod.sens_mvstck = 'E'::bpchar)
  GROUP BY p.num_prod
UNION ALL
 SELECT p.num_prod,
    COALESCE(sum(mvt_stock_prod.qte_mvstck), ((0)::numeric)::double precision) AS qte_sortie,
    0 AS qte_entree,
    p.lib_prod,
    p.code_prod,
    p.code_barre_prod
   FROM (mvt_stock_prod
     JOIN produit p ON ((p.num_prod = (mvt_stock_prod.num_prod)::numeric)))
  WHERE (mvt_stock_prod.sens_mvstck = 'S'::bpchar)
  GROUP BY p.num_prod;");

        DB::statement("CREATE VIEW \"vue_facture_creance\" AS  SELECT f.num_fact,
    f.code_fact,
    f.prix_ttc_fact,
    c.nom_cli,
    c.prenom_cli,
    ( SELECT sum(r.montant_ttc_reg) AS sum
           FROM reglement r
          WHERE (r.num_fact = f.num_fact)) AS montantpaye,
    f.date_val_fact
   FROM (facture f
     JOIN client c ON ((f.num_cli = c.num_cli)))
  WHERE ((f.solde_fact = false) AND (f.flag_fact = true));");

        DB::statement("CREATE VIEW \"vue_stock_prod_fam_old\" AS  SELECT p.num_prod,
    0 AS qte_sortie,
    COALESCE(sum(mvt_stock_prod.qte_mvstck), ((0)::numeric)::double precision) AS qte_entree,
    p.lib_prod,
    p.code_prod,
    p.code_barre_prod,
    sf.lib_sousfam,
    f.lib_fam
   FROM (((mvt_stock_prod
     JOIN produit p ON ((p.num_prod = (mvt_stock_prod.num_prod)::numeric)))
     JOIN sous_famille sf ON ((sf.num_sousfam = p.num_sousfam)))
     JOIN famille f ON ((f.num_fam = sf.num_fam)))
  WHERE (mvt_stock_prod.sens_mvstck = 'E'::bpchar)
  GROUP BY p.num_prod, sf.lib_sousfam, f.lib_fam
UNION ALL
 SELECT p.num_prod,
    COALESCE(sum(mvt_stock_prod.qte_mvstck), ((0)::numeric)::double precision) AS qte_sortie,
    0 AS qte_entree,
    p.lib_prod,
    p.code_prod,
    p.code_barre_prod,
    sf.lib_sousfam,
    f.lib_fam
   FROM (((mvt_stock_prod
     JOIN produit p ON ((p.num_prod = (mvt_stock_prod.num_prod)::numeric)))
     JOIN sous_famille sf ON ((sf.num_sousfam = p.num_sousfam)))
     JOIN famille f ON ((f.num_fam = sf.num_fam)))
  WHERE (mvt_stock_prod.sens_mvstck = 'S'::bpchar)
  GROUP BY p.num_prod, sf.lib_sousfam, f.lib_fam;");

        DB::statement("CREATE VIEW \"vue_stock_prod_fam\" AS  SELECT p.num_prod,
    0 AS qte_sortie,
    COALESCE(sum(mvt_stock_prod.qte_mvstck), ((0)::numeric)::double precision) AS qte_entree,
    p.lib_prod,
    p.code_prod,
    p.code_barre_prod,
    sf.lib_sousfam,
    f.lib_fam,
    mvt_stock_prod.num_agce
   FROM (((mvt_stock_prod
     JOIN produit p ON ((p.num_prod = (mvt_stock_prod.num_prod)::numeric)))
     JOIN sous_famille sf ON ((sf.num_sousfam = p.num_sousfam)))
     JOIN famille f ON ((f.num_fam = sf.num_fam)))
  WHERE (mvt_stock_prod.sens_mvstck = 'E'::bpchar)
  GROUP BY p.num_prod, sf.lib_sousfam, f.lib_fam, mvt_stock_prod.num_agce
UNION ALL
 SELECT p.num_prod,
    COALESCE(sum(mvt_stock_prod.qte_mvstck), ((0)::numeric)::double precision) AS qte_sortie,
    0 AS qte_entree,
    p.lib_prod,
    p.code_prod,
    p.code_barre_prod,
    sf.lib_sousfam,
    f.lib_fam,
    mvt_stock_prod.num_agce
   FROM (((mvt_stock_prod
     JOIN produit p ON ((p.num_prod = (mvt_stock_prod.num_prod)::numeric)))
     JOIN sous_famille sf ON ((sf.num_sousfam = p.num_sousfam)))
     JOIN famille f ON ((f.num_fam = sf.num_fam)))
  WHERE (mvt_stock_prod.sens_mvstck = 'S'::bpchar)
  GROUP BY p.num_prod, sf.lib_sousfam, f.lib_fam, mvt_stock_prod.num_agce;");

        Schema::table('role_has_permissions', function (Blueprint $table) {
            $table->foreign(['permission_id'])->references(['id'])->on('permissions')->onDelete('CASCADE');
            $table->foreign(['role_id'])->references(['id'])->on('roles')->onDelete('CASCADE');
        });

        Schema::table('sous_famille', function (Blueprint $table) {
            $table->foreign(['num_fam'], 'fk_sous_famille_famille')->references(['num_fam'])->on('famille');
        });

        Schema::table('role_has_sousmenus', function (Blueprint $table) {
            $table->foreign(['role_id'])->references(['id'])->on('roles')->onDelete('CASCADE');
            $table->foreign(['sousmenus_id_sousmenu'], 'role_has_sousmenus_sousmenu_id_foreign')->references(['id_sousmenu'])->on('sousmenu')->onDelete('CASCADE');
        });

        Schema::table('sousmenu', function (Blueprint $table) {
            $table->foreign(['menu_id_menu'])->references(['id_menu'])->on('menu')->onDelete('CASCADE');
        });

        Schema::table('bon_livraison', function (Blueprint $table) {
            $table->foreign(['num_comc'], 'fk_bon_livraison_commandeclient')->references(['num_comc'])->on('commandeclient');
        });

        Schema::table('facture', function (Blueprint $table) {
            $table->foreign(['num_bl'], 'fk_facture_bon_livraison')->references(['num_bl'])->on('bon_livraison');
        });

        Schema::table('commandeclient', function (Blueprint $table) {
            $table->foreign(['num_cli'], 'fk_commandeclient_client')->references(['num_cli'])->on('client');
        });

        Schema::table('commandefour', function (Blueprint $table) {
            $table->foreign(['num_agce'], 'fk_commandefour_agence')->references(['num_agce'])->on('agence');
            $table->foreign(['num_fourn'], 'fk_commandefour_fournisseur')->references(['num_fourn'])->on('fournisseur');
        });

        Schema::table('ligne_bl', function (Blueprint $table) {
            $table->foreign(['num_bl'], 'fk_ligne_bl_bon_livraison')->references(['num_bl'])->on('bon_livraison');
        });

        Schema::table('ligne_br', function (Blueprint $table) {
            $table->foreign(['num_prod'], 'fk_ligne_br_produit')->references(['num_prod'])->on('produit');
            $table->foreign(['num_br'], 'fk_ligne_br_reception_four')->references(['num_br'])->on('reception_four');
        });

        Schema::table('ligne_fact', function (Blueprint $table) {
            $table->foreign(['num_fact'], 'fk_ligne_fact_facture')->references(['num_fact'])->on('facture');
        });

        Schema::table('ligne_com', function (Blueprint $table) {
            $table->foreign(['num_comc'], 'fk_ligne_com_commandeclient')->references(['num_comc'])->on('commandeclient');
            $table->foreign(['num_prod'], 'fk_ligne_com_produit')->references(['num_prod'])->on('produit');
        });

        Schema::table('ligne_comfour', function (Blueprint $table) {
            $table->foreign(['num_comf'], 'fk_ligne_comfour_commandefour')->references(['num_comf'])->on('commandefour');
            $table->foreign(['num_prod'], 'fk_ligne_comfour_produit')->references(['num_prod'])->on('produit');
        });

        Schema::table('model_has_permissions', function (Blueprint $table) {
            $table->foreign(['permission_id'])->references(['id'])->on('permissions')->onDelete('CASCADE');
        });

        Schema::table('model_has_roles', function (Blueprint $table) {
            $table->foreign(['role_id'])->references(['id'])->on('roles')->onDelete('CASCADE');
        });

        Schema::table('reception_four', function (Blueprint $table) {
            $table->foreign(['num_comf'], 'fk_reception_four_commandefour')->references(['num_comf'])->on('commandefour');
        });

        Schema::table('rayon', function (Blueprint $table) {
            $table->foreign(['code_fa'], 'fk_rayon_famille')->references(['num_fam'])->on('famille');
        });

        Schema::table('sous_rayon', function (Blueprint $table) {
            $table->foreign(['code_ray'], 'fk_sous_rayon_rayon')->references(['code_ray'])->on('rayon');
        });

        Schema::table('produit', function (Blueprint $table) {
            $table->foreign(['num_sousfam'], 'fk_produit_sous_famille')->references(['num_sousfam'])->on('sous_famille');
        });

        Schema::table('client', function (Blueprint $table) {
            $table->foreign(['num_agce'], 'fk_client_agence')->references(['num_agce'])->on('agence');
            $table->foreign(['num_typecli'], 'fk_client_type_client')->references(['num_typecli'])->on('type_client');
        });

        Schema::table('avoir', function (Blueprint $table) {
            $table->foreign(['num_transactions'], 'fk_num_transactions_avoir')->references(['num_transactions'])->on('transactions');
            $table->foreign(['num_agce'], 'fk_num_agce_avoir')->references(['num_agce'])->on('agence');
        });

        Schema::table('retour_art', function (Blueprint $table) {
            $table->foreign(['id_num_avoir'], 'fk_retour_avoir')->references(['id_num_avoir'])->on('avoir');
        });

        Schema::table('transfert', function (Blueprint $table) {
            $table->foreign(['num_agce'], 'fk_agence_transfert')->references(['num_agce'])->on('agence');
        });

        Schema::table('ligne_transfert', function (Blueprint $table) {
            $table->foreign(['num_prod'], 'fk_produit_ltr')->references(['num_prod'])->on('produit');
            $table->foreign(['num_transf'], 'fk_transfert_ltr')->references(['num_transf'])->on('transfert');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ligne_transfert', function (Blueprint $table) {
            $table->dropForeign('fk_produit_ltr');
            $table->dropForeign('fk_transfert_ltr');
        });

        Schema::table('transfert', function (Blueprint $table) {
            $table->dropForeign('fk_agence_transfert');
        });

        Schema::table('retour_art', function (Blueprint $table) {
            $table->dropForeign('fk_retour_avoir');
        });

        Schema::table('avoir', function (Blueprint $table) {
            $table->dropForeign('fk_num_transactions_avoir');
            $table->dropForeign('fk_num_agce_avoir');
        });

        Schema::table('client', function (Blueprint $table) {
            $table->dropForeign('fk_client_agence');
            $table->dropForeign('fk_client_type_client');
        });

        Schema::table('produit', function (Blueprint $table) {
            $table->dropForeign('fk_produit_sous_famille');
        });

        Schema::table('sous_rayon', function (Blueprint $table) {
            $table->dropForeign('fk_sous_rayon_rayon');
        });

        Schema::table('rayon', function (Blueprint $table) {
            $table->dropForeign('fk_rayon_famille');
        });

        Schema::table('reception_four', function (Blueprint $table) {
            $table->dropForeign('fk_reception_four_commandefour');
        });

        Schema::table('model_has_roles', function (Blueprint $table) {
            $table->dropForeign('model_has_roles_role_id_foreign');
        });

        Schema::table('model_has_permissions', function (Blueprint $table) {
            $table->dropForeign('model_has_permissions_permission_id_foreign');
        });

        Schema::table('ligne_comfour', function (Blueprint $table) {
            $table->dropForeign('fk_ligne_comfour_commandefour');
            $table->dropForeign('fk_ligne_comfour_produit');
        });

        Schema::table('ligne_com', function (Blueprint $table) {
            $table->dropForeign('fk_ligne_com_commandeclient');
            $table->dropForeign('fk_ligne_com_produit');
        });

        Schema::table('ligne_fact', function (Blueprint $table) {
            $table->dropForeign('fk_ligne_fact_facture');
        });

        Schema::table('ligne_br', function (Blueprint $table) {
            $table->dropForeign('fk_ligne_br_produit');
            $table->dropForeign('fk_ligne_br_reception_four');
        });

        Schema::table('ligne_bl', function (Blueprint $table) {
            $table->dropForeign('fk_ligne_bl_bon_livraison');
        });

        Schema::table('commandefour', function (Blueprint $table) {
            $table->dropForeign('fk_commandefour_agence');
            $table->dropForeign('fk_commandefour_fournisseur');
        });

        Schema::table('commandeclient', function (Blueprint $table) {
            $table->dropForeign('fk_commandeclient_client');
        });

        Schema::table('facture', function (Blueprint $table) {
            $table->dropForeign('fk_facture_bon_livraison');
        });

        Schema::table('bon_livraison', function (Blueprint $table) {
            $table->dropForeign('fk_bon_livraison_commandeclient');
        });

        Schema::table('sousmenu', function (Blueprint $table) {
            $table->dropForeign('sousmenu_menu_id_menu_foreign');
        });

        Schema::table('role_has_sousmenus', function (Blueprint $table) {
            $table->dropForeign('role_has_sousmenus_role_id_foreign');
            $table->dropForeign('role_has_sousmenus_sousmenu_id_foreign');
        });

        Schema::table('sous_famille', function (Blueprint $table) {
            $table->dropForeign('fk_sous_famille_famille');
        });

        Schema::table('role_has_permissions', function (Blueprint $table) {
            $table->dropForeign('role_has_permissions_permission_id_foreign');
            $table->dropForeign('role_has_permissions_role_id_foreign');
        });

        DB::statement("DROP VIEW IF EXISTS \"vue_stock_prod_fam\"");

        DB::statement("DROP VIEW IF EXISTS \"vue_stock_prod_fam_old\"");

        DB::statement("DROP VIEW IF EXISTS \"vue_facture_creance\"");

        DB::statement("DROP VIEW IF EXISTS \"vue_stock_prod\"");

        Schema::dropIfExists('ligne_transfert');

        Schema::dropIfExists('transfert');

        Schema::dropIfExists('retour_art');

        Schema::dropIfExists('avoir');

        Schema::dropIfExists('cloture_caisse');

        Schema::dropIfExists('inventaireproduit');

        Schema::dropIfExists('inventaire_stock_articles');

        Schema::dropIfExists('fond_caisse');

        Schema::dropIfExists('transactions');

        Schema::dropIfExists('inventaire');

        Schema::dropIfExists('agence');

        Schema::dropIfExists('client');

        Schema::dropIfExists('produit');

        Schema::dropIfExists('logo');

        Schema::dropIfExists('sous_rayon');

        Schema::dropIfExists('rayon');

        Schema::dropIfExists('permissions');

        Schema::dropIfExists('reception_four');

        Schema::dropIfExists('mvt_stock_prod');

        Schema::dropIfExists('password_resets');

        Schema::dropIfExists('menu');

        Schema::dropIfExists('model_has_roles');

        Schema::dropIfExists('model_has_permissions');

        Schema::dropIfExists('ligne_comfour');

        Schema::dropIfExists('mode_paiement');

        Schema::dropIfExists('ligne_com');

        Schema::dropIfExists('famille');

        Schema::dropIfExists('fournisseur');

        Schema::dropIfExists('ligne_fact');

        Schema::dropIfExists('ligne_br');

        Schema::dropIfExists('ligne_bl');

        Schema::dropIfExists('commandefour');

        Schema::dropIfExists('commandeclient');

        Schema::dropIfExists('failed_jobs');

        Schema::dropIfExists('facture');

        Schema::dropIfExists('bon_livraison');

        Schema::dropIfExists('type_mvt_fond_caisse');

        Schema::dropIfExists('sousmenu');

        Schema::dropIfExists('role_has_sousmenus');

        Schema::dropIfExists('sous_famille');

        Schema::dropIfExists('type_client');

        Schema::dropIfExists('roles');

        Schema::dropIfExists('users');

        Schema::dropIfExists('tbl_modele');

        Schema::dropIfExists('tbl_form_whatsapp');

        Schema::dropIfExists('taxe');

        Schema::dropIfExists('tauxtva');

        Schema::dropIfExists('reglement');

        Schema::dropIfExists('role_has_permissions');
    }
};
