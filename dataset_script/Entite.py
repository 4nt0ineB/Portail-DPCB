
from random import randint
from fonctions import decrementDate
from fonctions import get_random_string
import random


def createEntreprise():
    TAUX_IMPAYE = 2  # 2 /10 -> 20%
    MAX_REMISES = 10
    MIN_TRANSACT = 2
    MAX_TRANSACT = 10

    noms_entreprises = []
    entreprises = []

    count_id = 0
    with open("Entries/entry.txt", "r") as entry_file:
        txt = entry_file.read().split("\n")
        noms_entreprises = list(filter(lambda x: len(x) < 40, txt))

    for i in range(1, len(noms_entreprises)):
        count_id = i
        entr = Entreprise(i, noms_entreprises[i].split()[0],
                          randint(1, 999999999), noms_entreprises[i], get_random_string(40), TAUX_IMPAYE, MAX_REMISES, MIN_TRANSACT, MAX_TRANSACT)

        entreprises.append(entr)

    return entreprises


class Entreprise:
    "Classe définissant une entreprise"

    def __init__(self, id_user, username, siren, raison, passw, taux_impaye, nbr_max_remises, transact_a, transact_b):

        self.id_user = id_user
        self.username = username
        self.siren = siren
        self.raison = raison
        self.passw = passw
        self.nbr_max_remises = nbr_max_remises
        self.transact_a = transact_a
        self.transact_b = transact_b
        self.nbr_remises = 0
        self.nbr_transactions = 0

        self.TAUX_IMPAYE = taux_impaye
        self.remises = []

        self.entreprise = []

    def createRemises(self):
        liste_date = decrementDate(
            "2020-09-19", 0, randint(0, self.nbr_max_remises))
        for datex in liste_date:
            # print(self.id_user)
            n_transaction = randint(self.transact_a, self.transact_b)

            remise = Remise(self.id_user, self.siren, self.raison, randint(
                1, 10000), datex, n_transaction, self.TAUX_IMPAYE)
            self.remises.append(remise.getDatas())

            self.nbr_transactions += n_transaction
            self.nbr_remises += 1

    def getDatas(self):
        self.createRemises()
        """
        id_user, username, password, siren,
        raison, nbr_remises, nbr_transactions, remises
        """
        self.entreprise = [self.id_user, self.username, self.passw, self.siren,
                           self.raison, self.nbr_remises, self.nbr_transactions, self.remises]

        self.entreprise.append(self.remises)
        return self.entreprise


class Remise:
    idd_remise = 1
    idd_transaction = 1
    idd_impaye = 1

    def __init__(self, id_user, siren, raison, num_remise, date_traitement, nbr_transactions, taux_impaye):
        self.id_user = id_user
        self.siren = siren
        self.raison = raison
        self.num_remise = num_remise
        self.date_traitement = date_traitement
        self.nbr_transactions = nbr_transactions
        self.devise = "(EUR)"
        self.montant = 0
        self.sens = "+"
        # Visa, MasterCard, UnionPay, JCB, American Express, Discover, Diners Club.
        # VS, MC, UP, JCB, AMEX, DCV, DC
        self.list_reseau = ["VS", "MC", "UP", "JCB", "AMX", "DCV", "DC"]
        self.list_libelle_impaye = ["transaction contestée", "double traitement",
                                    "Format invalide", "Emetteur non reconnu", "Provision insuffisante", "Compte bloqué"]
        self.remise = []
        self.transactions = []
        self.impayes = []
        self.taux_impaye = taux_impaye

    def createTransactions(self):

        liste_date = decrementDate(self.date_traitement, randint(1, 30), 0)
        for x in range(0, self.nbr_transactions):
            montant = 0
            sens_def = randint(0, 10)
            sens = "+"
            if(sens_def <= self.taux_impaye):
                montant = round(random.uniform(2.01, 99999.01), 2)
            else:
                montant = round(random.uniform(-2999.01, -0.01), 2)

            if(montant < 0):
                sens = "-"

            """
            id_transaction, siren, date_vente, num_carte, reseau,
            num_autorisation, montant, sens, id_remise, id_devise_DEVISE
            """
            data_transac = [Remise.idd_transaction, self.siren, random.choice(liste_date), str(randint(0, 99999))+"*******"+str(
                randint(0, 9999)), random.choice(self.list_reseau), randint(1, 999999), round(montant, 2), sens, Remise.idd_remise, randint(1, 168)]
            Remise.idd_transaction += 1

            if(sens == "-"):
                # -> Impayé une fois sur 4 (autrement c'est un débit normal du compte courant)
                if(randint(0, 4) == 4):
                    impaye = [data_transac[0], Remise.idd_impaye, self.date_traitement, randint(
                        0, 99999), random.choice(self.list_libelle_impaye)] + data_transac[1:]
                    self.impayes.append(impaye)
                Remise.idd_impaye += 1

            self.transactions.append(data_transac)

            self.montant += montant

        if(self.montant < 0):
            self.sens = "-"

        """
        id_remise, siren, raison, num_remise, date_traitement
        nbr_transaction, montant, sens, id_user, id_devise_DEVISE
        """
        self.remise = [Remise.idd_remise, self.siren, self.raison, self.num_remise, self.date_traitement,
                       self.nbr_transactions, round(self.montant, 2), self.sens, self.id_user, "2", self.transactions]
        Remise.idd_remise += 1

        self.remise.append(self.transactions)
        self.remise.append(self.impayes)

    def getDatas(self):
        self.createTransactions()
        return self.remise
