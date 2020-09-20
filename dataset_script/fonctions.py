import random
import string


def get_random_string(length):
    # Random string with the combination of lower and upper case
    letters = string.ascii_letters
    result_str = ''.join(random.choice(letters) for i in range(length))
    return result_str


def bissextile(annee):
    if(annee % 4 == 0 and annee % 100 != 0 or annee % 400 == 0):
        return 29
    else:
        return 28


def decrementDate(date, nbr_jours, nbr_mois):
    """ On indique une date de départ et un nombre de mois,
    - retourn une liste de dates, décrémenté de la date de départ par le nombre de mois,
    1 mois considéré comme un laps de temps fixe de 30 jours """

    date0 = date.split("-")
    date = []
    for elem in date0:
        if elem.startswith('0'):
            date.append(elem.replace("0", ''))
        else:
            date.append(elem)

    annee = date[0]
    mois = date[1]
    jour = date[2]
    liste_date = []

    nbr_jours_mois = {"1": 31, "2": -1, "3": 31, "4": 30, "5": 31, "6": 30,
                      "7": 31, "8": 31, "9": 30, "10": 31, "11": 30, "12": 31}

    for i in range(nbr_jours):
        jour = int(jour) - 1

        if(jour <= 0):
            mois = int(mois) - 1
            if(mois == 0):
                mois = 12
                annee = int(annee) - 1
            if(mois == 2):
                jour = bissextile(int(annee))
            else:
                jour = int(nbr_jours_mois[str(mois)])
        new_date = str(annee)+"-"+("0" + str(mois) if int(mois) < 10 else str(mois)) + \
            "-"+("0" + str(jour) if int(jour) < 10 else str(jour))
        liste_date.append(new_date)

    for j in range(nbr_mois):
        reste = int(jour) - 30
        if(reste <= 0):
            mois = int(mois) - 1
            if(mois == 0):
                mois = 12
                annee = int(annee) - 1
            if(mois == 2):
                jour = bissextile(int(annee)) - (reste * -1)
            else:
                jour = int(nbr_jours_mois[str(mois)]) - (reste * -1)
        new_date = str(annee)+"-"+("0" + str(mois) if int(mois) < 10 else str(mois)) + \
            "-"+("0" + str(jour) if int(jour) < 10 else str(jour))
        liste_date.append(new_date)

    return liste_date
