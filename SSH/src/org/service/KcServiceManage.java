package org.service;

import org.dao.imp.Cjdao;
import org.dao.imp.Kcdao;
import org.model.KcbEntity;

import java.util.List;

/**
 * Created by wujiacheng on 16/6/5.
 */
public class KcServiceManage implements KcService {
    private Kcdao kcDao;
    private Cjdao cjDao;

    public Cjdao getCjDao() {
        return cjDao;
    }

    public void setCjDao(Cjdao cjDao) {
        this.cjDao = cjDao;
    }

    public Kcdao getKcDao() {
        return kcDao;
    }

    public void setKcDao(Kcdao kcDao) {
        this.kcDao = kcDao;
    }

    @Override
    public void save(KcbEntity kc) {
        kcDao.save(kc);
    }

    @Override
    public void delete(String kch) {
        kcDao.delete(kch);
        cjDao.deleteOneKcInfo(kch);
    }

    @Override
    public void update(KcbEntity kc) {
        kcDao.update(kc);
    }

    @Override
    public KcbEntity find(String kch) {
        return kcDao.find(kch);
    }

    @Override
    public List findAll(int pageNow, int pageSize) {
        return kcDao.findAll(pageNow, pageSize);
    }

    @Override
    public int findKcSize() {
        return kcDao.findKcSize();
    }
}
