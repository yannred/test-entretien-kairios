export const PRIORITAIRE = 1;
export const DANS_L_HEURE = 2;
export const DANS_LA_JOURNEE = 3;
export const DANS_LES_48_HEURES = 4;

export const getAll = () => {
    return [PRIORITAIRE, DANS_L_HEURE, DANS_LA_JOURNEE, DANS_LES_48_HEURES];
};

export const getLabel = (type) => {
    switch (type) {
        case PRIORITAIRE:
            return 'Prioritaire';
        case DANS_L_HEURE:
            return 'Dans l\'heure';
        case DANS_LA_JOURNEE:
            return 'Dans la journée';
        case DANS_LES_48_HEURES:
            return 'Dans les 48 heures';
        default:
            return 'Aucun type';
    }
};