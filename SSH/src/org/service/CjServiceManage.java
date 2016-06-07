package org.service;

import org.dao.imp.Cjdao;
import org.model.CjbEntity;

import java.util.List;

/**
 * Created by wujiacheng on 16/6/5.
 */
public class CjServiceManage implements CjService {

    private Cjdao cjDao;

    public Cjdao getCjDao() {
        return cjDao;
    }

    public void setCjDao(Cjdao cjDao) {
        this.cjDao = cjDao;
    }

    @Override
    public void saveorupdateCj(CjbEntity cj) {
        cjDao.saveorupdateCj(cj);
    }

    @Override
    public void deleteCj(String xh, String kch) {
        cjDao.deleteCj(xh, kch);
    }

    @Override
    public CjbEntity getXsCj(String xh, String kch) {
        return cjDao.getXsCj(xh, kch);
    }

    @Override
    public List findAllCj(int pageNow, int pageSize) {
        return cjDao.findAllCj(pageNow, pageSize);
    }

    @Override
    public List getXsCjList(String xh) {
        return cjDao.getXsCjList(xh);
    }

    @Override
    public List getKcCjList(String kch) {
        return cjDao.getKcCjList(kch);
    }

    @Override
    public void deleteOneXsCj(String xh) {
        cjDao.deleteOneXsCj(xh);
    }

    @Override
    public void deleteOneKcInfo(String kch) {
        cjDao.deleteOneKcInfo(kch);
    }

    @Override
    public int findCjSize() {
        return cjDao.findCjSize();
    }
}
