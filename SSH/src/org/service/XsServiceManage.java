package org.service;

import org.model.XsbEntity;
import org.dao.imp.Xsdao;
import org.dao.imp.Cjdao;
import java.util.List;

/**
 * Created by wujiacheng on 16/6/5.
 */
public class XsServiceManage implements XsService {
    private Xsdao xsDao;
    private Cjdao cjDao;

    public Xsdao getXsDao() {
        return xsDao;
    }

    public void setXsDao(Xsdao xsDao) {
        this.xsDao = xsDao;
    }

    public Cjdao getCjDao() {
        return cjDao;
    }

    public void setCjDao(Cjdao cjDao) {
        this.cjDao = cjDao;
    }

    @Override
    public void save(XsbEntity xs) {
        xsDao.save(xs);
    }

    @Override
    public void delete(String xh) {
        //删除学生时同时要删除对应成绩
        xsDao.delete(xh);
        cjDao.deleteOneXsCj(xh);

    }

    @Override
    public void update(XsbEntity xs) {
        xsDao.update(xs);
    }

    @Override
    public XsbEntity find(String xh) {
        return xsDao.find(xh);
    }

    @Override
    public List findAll(int pageNow, int pageSize) {
        return xsDao.findAll(pageNow, pageSize);
    }

    @Override
    public int findXsSize() {
        return xsDao.findXsSize();    }
}
