from Entite import *
from random import randint
import random

if __name__ == "__main__":
    # année de la forme AAAA-MM-JJ pour correspondre à mysql

    # Création d'une liste de noms d'entreprises
    clients = createEntreprise()

    """ Création d'une liste d'objets "Enteprise" 
        (appelé client dans la bdd) et création de ses données (infos + remises + transactions / impayés) """
    clts = []
    for i in range(len(clients)-2):
        clts.append(clients[i].getDatas())

    USER = []
    CLIENT = []
    REMISE = []
    TRANSACTION = []
    IMPAYE = []
    DEVISE = {}

    liste_of_list_remises = []
    list_of_list_transactions = []
    list_of_list_impayes = []

    # CLIENT | id_user, username, password, siren, raison, nbr_remises, nbr_transactions, remises[]

    # REMISE | id_remise, siren, raison, num_remise, date_traitement nbr_transaction, montant, sens, id_user, id_devise_DEVISE, transactions[]

    # TRANSACTION | id_transaction, siren, date_vente, num_carte, reseau, num_autorisation, montant, sens, id_remise, id_devise_DEVISE

    """ Création des users et clients """
    for client in clts:
        USER.append(client[0:3])
        c = client[0:-4]
        CLIENT.append([c[0], c[3], c[4], c[1], c[2]])
        liste_of_list_remises.append(client[-1])

    """ Création de la liste des remises """
    for list_of_remises in liste_of_list_remises:
        for remise in list_of_remises:
            REMISE.append(remise[0:10])
            # Stockage des listes de transactions
            list_of_list_transactions.append(remise[11])
            # Stockage des listes d'impayés
            list_of_list_impayes.append(remise[12])

    """ Création de la liste des transactions """
    for i in range(len(list_of_list_transactions)-1):
        for e in list_of_list_transactions[i]:
            TRANSACTION.append(e)

    """ Création de la liste des impayés """
    for impaye in list_of_list_impayes:
        for e in impaye:
            IMPAYE.append(e)

    for x in REMISE:
        # print(x)
        pass

    """ Données bruts
    with open("Out/datasetv1.sql", "w") as sql_file:
        l = []
        for x in [USER, CLIENT, REMISE, TRANSACTION, IMPAYE]:
            for data in x:
                txt = ""
                txt += ''.join(str(data))
                txt += ""
                
                sql_file.write(txt)
    """

    """ Entrée des devises """
    with open("Entries/devises.txt", "r") as devise_txt:
        list_devise = devise_txt.read().split("\n")
        for devise in list_devise:
            l = devise.split(";")
            if(l[1] not in DEVISE.keys()):
                DEVISE[l[1]] = ""
            DEVISE[l[1]] = l[0]

    """ Sortie sql """
    with open("Out/datasetv1.sql", "w") as sql_file:

        # Données de la table devise géré différement
        sql_DEVISE = "\n--\n-- Contenu de la table `DEVISE`\n--\n"
        sql_DEVISE += "INSERT INTO `DEVISE` (`nom_devise`,`libelle`) VALUES\n"

        sql_DEVISE += "\n('"+list(DEVISE.keys()
                                  )[0].replace("'", "\\'")+"', '"+list(DEVISE.values())[0]+"')"
        for devise, lib in list(DEVISE.items())[1:-1]:
            sql_DEVISE += ",\n('"+lib.replace("'", "\\'")+"', '"+devise+"')"
        sql_DEVISE += ";"
        sql_file.write(sql_DEVISE)

        sql_USER = "\n--\n-- Contenu de la table `USER`\n--\n"
        sql_USER += "INSERT INTO `USER` (`id_user`,`username`,`password`) VALUES\n"

        sql_CLIENT = "\n--\n-- Contenu de la table `CLIENT`\n--\n"
        sql_CLIENT += "INSERT INTO `CLIENT` (`id_user`,`siren`,`raison`,`username`,`password`) VALUES\n"

        sql_REMISE = "\n--\n-- Contenu de la table `REMISE`\n--\n"
        sql_REMISE += "INSERT INTO `REMISE` (`id_remise`,`siren`,`raison`, `num_remise`,`date_traitement`,`nbr_transaction`, `montant`, `sens`, `id_user`, `id_devise`) VALUES\n"

        sql_TRANSACTION = "\n--\n-- Contenu de la table `TRANSACTION`\n--\n"
        sql_TRANSACTION = "INSERT INTO `TRANSACTION` (`id_transaction`,`siren`,`date_vente`,`num_carte`,`reseau`, `num_autorisation`, `montant`, `sens`, `id_remise`,`id_devise`) VALUES\n"

        sql_IMPAYE = "\n--\n-- Contenu de la table `IMPAYE`\n--\n"
        sql_IMPAYE += "INSERT INTO `IMPAYE` (`id_transaction`, `id_impaye`, `date_remise`, `num_dossier`, `libelle`, `siren`,`date_vente`,`num_carte`,`reseau`, `num_autorisation`, `montant`, `sens`, `id_remise`,`id_devise`) VALUES\n"

        list_data_table = [sql_USER, sql_CLIENT,
                           sql_REMISE, sql_TRANSACTION, sql_IMPAYE]
        list_datas = [USER, CLIENT, REMISE, TRANSACTION, IMPAYE]

        for i in range(0, 5):
            list_data_table[i] += "("+str(list_datas[i][0][0])
            for d in list_datas[i][0][1:]:

                s = str(d)
                if(s.isnumeric()):
                    list_data_table[i] += ", " + s
                else:
                    list_data_table[i] += ", '"+s+"'"
            list_data_table[i] += ")"

            for datas in list_datas[i][1:-1]:
                txt = ""
                txt = ",\n("+str(datas[0])
                for data in datas[1:]:
                    s = str(data)
                    if(s.isnumeric()):
                        txt += ", " + s
                    else:
                        txt += ", '"+s+"'"
                txt += ")"
                list_data_table[i] += txt

            list_data_table[i] += ";\n\n"
            sql_file.write(list_data_table[i])
