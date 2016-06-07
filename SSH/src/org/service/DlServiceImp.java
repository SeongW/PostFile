package org.service;

import org.model.DlbEntity;
import org.dao.imp.Dldao;
/**
 * Created by wujiacheng on 16/5/31.
 */
public class DlServiceImp implements DlService {

    //对DlDao进行依赖注入
    private Dldao dlDao;
    public void setDlDao(Dldao dlDao) {
        this.dlDao = dlDao;
    }

    @Override
    public DlbEntity find(String xh, String kl) {
            return dlDao.find(xh, kl);
    }

    @Override
    public boolean existXh(String xh) {
        return dlDao.existXh(xh);
    }

    @Override
    public void save(DlbEntity user) {
        dlDao.save(user);
    }
}
